<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $transaction->transaction_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
        }

        .info-table,
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .info-table td,
        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .items-table th {
            background: #f8f8f8;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
        }
    </style>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>

<body>

    <div class="container">
        <div class="header">
            <h1 class="invoice-title">Invoice</h1>
        </div>

        <table class="info-table">
            <tr>
                <td><strong>Date:</strong> {{ $transaction->created_at->format('d M Y') }}</td>
                <td><strong>Transaction ID:</strong> {{ $transaction->transaction_id }}</td>
            </tr>
            <tr>
                <td><strong>Order ID:</strong> {{ $transaction->order->id }}</td>
                <td><strong>Status:</strong> {{ ucfirst($transaction->status) }}</td>
            </tr>
        </table>

        <h3>Billing Details</h3>
        <table class="info-table">
            <tr>
                <td><strong>Name:</strong> {{ auth()->user()->name }}</td>
                <td><strong>Email:</strong> {{ auth()->user()->email }}</td>
            </tr>
        </table>

        <h3>Course Details</h3>
        <table class="items-table">
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
                        <td class="text-right"> <i
                                class="uil uil-rupee-sign"></i>{{ number_format($item->course->price, 2) }}</td>
                        <td class="text-right"> <i
                                class="uil uil-rupee-sign"></i>{{ number_format($item->course->discount, 2) }}</td>
                        <td class="text-right"> <i
                                class="uil uil-rupee-sign"></i>{{ number_format($item->payable_amount, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                    <td class="text-right"><strong> <i
                                class="uil uil-rupee-sign"></i>{{ number_format($transaction->amount, 2) }}</strong>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Thank you for your purchase!</p>
        </div>
    </div>

</body>

</html>