<?php

namespace App\Http\Controllers;
use Razorpay\Api\Api;
use App\Models\order;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\order_item;
use App\Models\user_course;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::with(['course.user'])
        ->where('user_id', auth()->id())
        ->where('is_wishlist', 0)
        ->get();
        //return $cartItems;
        return view('learner.checkout.checkout',compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    
    
    
     public function store(Request $request)
     {
         $request->validate([
             'address.first_name' => 'required|string|max:255',
             'address.last_name' => 'required|string|max:255',
             'address.address' => 'required|string|max:255',
             'address.city' => 'required|string|max:255',
             'address.state' => 'required|string|max:255',
             'address.zip_code' => 'required|string|max:20',
             'address.phone' => 'required|string|max:20',
             'address.country' => 'required|string|max:255',
         ]);
     
         $data = $request->all();
         Log::info("Checkout data received: ", $data);
     
         DB::beginTransaction();
         
         try {
             // 1️⃣ Insert Order
             $order = Order::create([
                 'user_id' => $data['user_id'],
                 'total_course' => $data['total_course'],
                 'total_amount' => $data['total_amount'],
                 'total_discount' => $data['total_discount'],
                 'payable_amount' => $data['payable_amount'],
                 'booking_number' => $data['booking_number'],
                 'payment_status' => 'pending',
                 'first_name' => $data['address']['first_name'],
                 'last_name' => $data['address']['last_name'],
                 'address' => $data['address']['address'],
                 'city' => $data['address']['city'],
                 'state' => $data['address']['state'],
                 'zip_code' => $data['address']['zip_code'],
                 'phone' => $data['address']['phone'],
                 'country' => $data['address']['country'],
                 'create_by' => $data['create_by']
             ]);
             
             Log::info("Order created successfully: ", ['order_id' => $order->id]);
     
             // 2️⃣ Insert into OrderItems table
             foreach ($data['courses'] as $course) {
                order_item::create([
                     'order_id' => $order->id,
                     'course_id' => $course['Course_id'],
                     'amount' => $course['Amount'],
                     'discount' => $course['Discount'],
                     'payable_amount' => $course['Payable_amount'],
                     'create_by' => $data['create_by']
                 ]);
             }
     
             // 3️ Create Razorpay Order
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            // Convert amount to paise (Razorpay requires amount in paise)
            $amountInPaise = intval($data['payable_amount'] * 100);

            // Create Razorpay Order
            $razorpayOrder = $api->order->create([
                'receipt' => 'order_' . $order->id,
                'amount' => $amountInPaise,
                'currency' => 'INR',
                'payment_capture' => 1
            ]);

            Log::info("Razorpay Order Created:", ['razorpay_order_id' => $razorpayOrder['id']]);

            if (!$razorpayOrder || !isset($razorpayOrder['id'])) {
                Log::error("Failed to create Razorpay order.");
                return back()->with('error', 'Failed to initiate payment. Please try again.');
            }

            DB::commit();
            
            Log::info("Razorpay order created successfully: ", ['razorpay_order_id' => $razorpayOrder['id']]);

            // ✅ Return JSON response with the redirect URL
            return response()->json([
                'success' => true,
                'razorpay_order_id' => $razorpayOrder['id'],
                'amount' => $data['payable_amount'],
                'order_id' => $order->id
            ]);

     
         } catch (\Exception $e) {
             DB::rollBack();
             Log::error("Checkout transaction failed:", ['error' => $e->getMessage()]);
     
             return response()->json([
                 'success' => false,
                 'message' => 'Error processing order.',
                 'error' => $e->getMessage()
             ], 500);
         }
     }

     public function handlePaymentSuccess(Request $request)
    {
        $razorpayPaymentId = $request->razorpay_payment_id;
        $razorpayOrderId = $request->razorpay_order_id;
        $razorpaySignature = $request->razorpay_signature;
        $orderId = $request->order_id;

        Log::info("Razorpay Payment Attempt", [
            'order_id' => $orderId,
            'razorpay_order_id' => $razorpayOrderId,
            'razorpay_payment_id' => $razorpayPaymentId,
            'razorpay_signature' => $razorpaySignature
        ]);

        try {
            // ✅ Verify Signature (Security check)
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $attributes = [
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_signature' => $razorpaySignature
            ];
            
            $api->utility->verifyPaymentSignature($attributes);
            Log::info("Razorpay Signature Verified Successfully", ['order_id' => $orderId]);

            // ✅ Update order payment status in database
            PaymentTransaction::create([
                'order_id' => $orderId,
                'transaction_id' => $razorpayPaymentId,
                'status' => 'success',
                'amount' => Order::find($orderId)->payable_amount,
                'created_by' => auth()->id()
            ]);
            $order = Order::find($orderId);
            logger($order);
            $order->update(['payment_status' => 'paid']);
            logger('order updated');
            $orderItems = order_item::where('order_id', $orderId)->get();
            foreach ($orderItems as $item) {
                user_course::create([
                    'user_id' => $order->user_id,
                    'course_id' => $item->course_id,
                    'create_by' => auth()->id()
                ]);

                //remove course from cart
                Cart::where('user_id', $order->user_id)
                ->where('course_id', $item->course_id)
                ->delete();
            }
            logger('user_course created');


            Log::info("Payment Transaction Recorded Successfully", ['order_id' => $orderId]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error("Razorpay Payment Verification Failed", [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);

            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
// public function paymentCallback(Request $request)
// {
//     Log::info("Payment Callback Initiated", $request->all());

//     $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

//     $attributes = [
//         'razorpay_order_id' => $request->razorpay_order_id,
//         'razorpay_payment_id' => $request->razorpay_payment_id,
//         'razorpay_signature' => $request->razorpay_signature,
//     ];

//     Log::info("Received Payment Attributes", $attributes);

//     try {
//         $api->utility->verifyPaymentSignature($attributes);
//         Log::info("Payment signature verified successfully");

//         $order = Order::find($request->order_id);

//         if (!$order) {
//             Log::error("Order not found", ['order_id' => $request->order_id]);
//             return redirect('/payment-failed')->with('error', 'Payment Failed: Order not found.');
//         }

//         Log::info("Order found", ['order_id' => $order->id]);

//         // Create Payment Transaction
//         $payment = PaymentTransaction::create([
//             'order_id' => $order->id,
//             'transaction_id' => $request->razorpay_payment_id,
//             'status' => 'success',
//             'amount' => $order->payable_amount,
//             'created_by' => $order->user_id,
//         ]);

//         Log::info("PaymentTransaction Created", ['transaction_id' => $payment->transaction_id]);

//         // Update Order Payment Status
//         $order->update(['payment_status' => 'paid']);
//         Log::info("Order status updated to paid", ['order_id' => $order->id]);

//         return redirect('/payment-success')->with('success', 'Payment Successful!');

//     } catch (\Exception $e) {
//         Log::error("Payment Failed", ['error' => $e->getMessage()]);
//         return redirect('/payment-failed')->with('error', 'Payment Failed: ' . $e->getMessage());
//     }
// }

     

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        //
    }
}
