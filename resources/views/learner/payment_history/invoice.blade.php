@extends('learner.layout.master')

@section('title')
   Invoice
@endsection

@section('content_learner')
<div class="wrapper">		
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="invoice_body">
                    <div class="invoice_date_info">
                        <ul>
                            <li><div class="vdt-list"><span>Date :</span> {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}</div></li>
                            <li><div class="vdt-list"><span>Transaction ID :</span> {{ $transaction->transaction_id }}</div></li>
                            <li><div class="vdt-list"><span>Order ID :</span> {{ $transaction->order->id }}</div></li>
                        </ul>
                    </div>
                    <div class="invoice_dts">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="invoice_title">Invoice</h2>
                            </div>
                            <div class="col-md-6">
                                <div class="vhls140">
                                    <h4>To</h4>
                                    <ul>
                                        <li><div class="vdt-list">{{ auth()->user()->name }}</div></li>
                                        <li><div class="vdt-list">{{ auth()->user()->email }}</div></li>
                                    </ul>
                                </div>		
                            </div>
                            <div class="col-md-6">
                                <div class="vhls140">
                                    <h4>Seller</h4>
                                    <ul>
                                        <li><div class="vdt-list">CodePilot LTD</div></li>
                                        {{-- <li><div class="vdt-list">Ludhiana, Punjab, India</div></li> --}}
                                    </ul>
                                </div>		
                            </div>
                        </div>
                    </div>
                    <div class="invoice_table">
                        <div class="table-responsive-md">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                      <th scope="col">Item</th>
                                      <th scope="col">Price</th>
                                      <th scope="col">Discount</th>
                                      <th scope="col">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->order->order_items as $item)
                                        <tr>
                                            <th scope="row">
                                                <div class="user_dt_trans">
                                                    <p>{{ $item->course->title }}</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="user_dt_trans">														
                                                    <p>${{ number_format($item->course->price, 2) }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="user_dt_trans">
                                                    <p>${{ number_format($item->course->discount, 2) }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="user_dt_trans">														
                                                    <p>${{ number_format($item->payable_amount, 2) }}</p>
                                                </div>
                                            </td>												
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="1"></td>
                                        <td colspan="3">
                                            <div class="user_dt_trans jsk1145">														
                                                <div class="totalinv2">Invoice Total : ₹{{ number_format($transaction->amount, 2) }}</div>
                                                <p>Paid via Razorpay</p>
                                            </div>
                                        </td>												
                                    </tr>											
                                </tbody>
                            </table>														
                        </div>
                    </div>
                    <div class="invoice_footer">
                        <div class="leftfooter">
                            <p>Thanks for buying.</p>
                        </div>
                        <div class="righttfooter">
                            <a class="print_btn" href="javascript:window.print();">Print</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>
@endsection
