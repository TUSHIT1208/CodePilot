<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;
use Illuminate\Http\Request;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paymentTransactions = PaymentTransaction::whereIn('order_id', function ($query) {
            $query->select('order_id')
                ->from('order_items')
                ->whereIn('course_id', function ($subQuery) {
                    $subQuery->select('id')
                        ->from('courses')
                        ->where('user_id', auth()->user()->id);
                });
        })->get();
        if (auth()->user()->role->name === 'admin') {
            if ($request->ajax()) {
                logger($paymentTransactions);
                return DataTables::of($paymentTransactions)
                    ->addColumn('course_name', function ($row) {
                        // Display all course names related to the payment transaction
                        logger($row->order->order_items->pluck('course.title')->join(', '));
                        return $row->order->order_items->pluck('course.title')->join(', ') ?? 'N/A';
                    })
                    ->editColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->format('d M Y, h:i A'); // Example: 09 Mar 2025, 10:45 AM
                    })
                    ->make(true);
            }
            return view('admin.payment_history.list', compact('paymentTransactions'));
        }
    }

    public function learner_payment_history(Request $request)
    {
        if ($request->ajax()) {
            try {
                $paymentTransactions = PaymentTransaction::whereHas('order.order_items.course')
                    ->where('created_by', auth()->id()) // Ensure only transactions of logged-in user
                    ->with('order.order_items.course') // Eager load course details
                    ->get();

                return DataTables::of($paymentTransactions)
                    ->addColumn('course_name', function ($row) {
                        return $row->order->order_items->pluck('course.title')->join(', ') ?? 'N/A';
                    })
                    ->addColumn('invoice', function ($row) {
                        return '
                            <a href="' . route('invoice.view', $row->id) . '" class="text-primary" title="View Invoice">
                                <i class="uil uil-eye"></i>
                            </a>
                            <a href="' . route('invoice.download', $row->id) . '" class="text-success ms-2" title="Download Invoice">
                                <i class="uil uil-download-alt"></i>
                            </a>';
                    })
                    ->editColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->format('d M Y, h:i A');
                    })
                    ->rawColumns(['invoice']) // Ensure HTML is rendered properly
                    ->make(true);

            } catch (\Exception $e) {
                Log::error("Error in learner_payment_history: " . $e->getMessage());
                return response()->json(['error' => 'Something went wrong!'], 500);
            }
        }

        return view('learner.payment_history.list');
    }

    public function viewInvoice($id)
    {
        $transaction = PaymentTransaction::where('id', $id)
            ->where('created_by', auth()->id()) // Ensure user owns the transaction
            ->with('order.order_items.course')
            ->firstOrFail();

        return view('learner.payment_history.invoice', compact('transaction'));
    }

    // Download invoice as PDF
    public function downloadInvoice($id)
    {
        $transaction = PaymentTransaction::where('id', $id)
            ->where('created_by', auth()->id()) // Ensure user owns the transaction
            ->with('order.order_items.course')
            ->firstOrFail();

        $pdf = Pdf::loadView('learner.payment_history.pdf', compact('transaction'));

        // Return the PDF for download
        return $pdf->download("invoice-{$transaction->transaction_id}.pdf");
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentTransaction $paymentTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentTransaction $paymentTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentTransaction $paymentTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentTransaction $paymentTransaction)
    {
        //
    }
}