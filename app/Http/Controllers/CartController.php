<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\order;
use App\Models\order_item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::with('course.courseattachment') // Eager load course and courseAttachment
        ->where('user_id', auth()->id())
        ->where('is_wishlist', 0)
        ->get();
            // return $cartItems;
            logger($cartItems);
        return view('learner.cart.shopping_cart',compact('cartItems'));
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
        $user = auth()->user(); // Get the authenticated user

        $existingCartItem = Cart::where('user_id', $user->id)
            ->where('course_id', $request->course_id)
            ->where('is_wishlist', 0)
            ->first();
        if ($existingCartItem) {
            return response()->json(['message' => 'Course is already in the cart'], 409);
        }

        $paidOrders = Order::where('user_id', auth()->user()->id)->pluck('id'); // pluck() to get only the order IDs
        $alreadyPurchased = order_item::where('course_id', $request->course_id)
            ->whereIn('order_id', $paidOrders)
            ->exists();

        if ($alreadyPurchased) {
            return response()->json(['message' => 'You have already purchased this course'], 409);
        }
        
        Cart::create([
            'user_id' => $user->id,
            'course_id' => $request->course_id,
            'is_wishlist' => 0,
            'created_by' => $user->id,
        ]);
        
        return response()->json(['message' => 'Course added to cart successfully'], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('Course removed from cart successfully');
    }
    public function getCounts()
    {
        $userId = auth()->id();

        $cartCount = Cart::where('user_id', $userId)
        ->where('is_wishlist', 0)
        ->count();
        // $wishlistCount = Wishlist::where('user_id', $userId)->count();

        return response()->json([
            'cartCount' => $cartCount,
            // 'wishlistCount' => $wishlistCount,
        ]);
    }
}
