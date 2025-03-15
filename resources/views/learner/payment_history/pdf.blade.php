<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">		
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <title>CodePilot - Invoice Membership</title>
    
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/fav.png') }}">
    
    <!-- Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,500" rel="stylesheet">
    <link href="{{ asset('vendor/unicons-2.0.1/css/unicons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vertical-responsive-menu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    
    <!-- Vendor Stylesheets -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/OwlCarousel/assets/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/OwlCarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/semantic/semantic.min.css') }}">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        .invoice_header {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .invoice_header .invoice_logo img {
            max-width: 150px;
        }

        .invoice_date_info {
            text-align: right;
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .invoice_date_info .vdt-list {
            margin-bottom: 5px;
        }

        .invoice_body {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .invoice_title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .vhls140 h4 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #444;
        }

        .vdt-list {
            font-size: 14px;
            color: #666;
        }

        .invoice_table th {
            background-color: #f9f9f9;
            color: #333;
            font-weight: 600;
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .invoice_table td {
            padding: 10px;
            font-size: 14px;
            color: #555;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .totalinv2 {
            font-size: 18px;
            font-weight: bold;
            color: #111;
            margin-top: 10px;
            text-align: right;
        }

        .invoice_footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .leftfooter p {
            font-size: 14px;
            color: #555;
        }

        .print_btn {
            background-color: #e53935;
            color: #fff;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .print_btn:hover {
            background-color: #c62828;
        }
    </style>
</head>

<body>

<!-- Header Start -->
<header class="invoice_header clearfix">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="invoice_header_main">
                    <div class="invoice_header_item">
                        <div class="invoice_logo">
                            <a href=""><img src="{{ asset('images/ct_logo.svg') }}" alt="CodePilot"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->

<!-- Body Start -->
<div class="wrapper">		
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="invoice_body">
                    <div class="invoice_date_info">
                        <div class="vdt-list">Date : {{ $transaction->created_at->format('d M Y') }}</div>
                        <div class="vdt-list">Transaction ID : {{ $transaction->transaction_id }}</div>
                        <div class="vdt-list">Order ID : {{ $transaction->order->id }}</div>
                    </div>

                    <div class="invoice_dts">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="vhls140">
                                    <h4>To</h4>
                                    <div>{{ auth()->user()->name }}</div>
                                    <div>{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="vhls140">
                                    <h4>CodePilot</h4>
                                    <div>CodePilot LTD</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="invoice_table">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction->order->order_items as $item)
                                <tr>
                                    <td>{{ $item->course->title }}</td>
                                    <td>₹{{ number_format($item->course->price, 2) }}</td>
                                    <td>₹{{ number_format($item->course->discount, 2) }}</td>
                                    <td>₹{{ number_format($item->payable_amount, 2) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Invoice Total:</strong></td>
                                    <td>₹{{ number_format($transaction->amount, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="invoice_footer">
                        <div class="leftfooter">
                            <p>Thanks for buying.</p>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Body End -->

</body>
</html>
