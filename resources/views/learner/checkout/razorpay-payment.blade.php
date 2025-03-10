<!DOCTYPE html>
<html>
<head>
    <title>Complete Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <h2>Complete Your Payment</h2>
    <p>Amount: ₹<span id="amount">{{ $amount }}</span></p>
    <button id="pay-btn">Pay Now</button>

    <script>
        var options = {
            "key": "{{ $key }}", 
            "amount": "{{ $amount * 100 }}",
            "currency": "{{ $currency }}",
            "name": "Course Purchase",
            "description": "Pay for your courses",
            "order_id": "{{ $razorpay_order_id }}",
            "handler": function (response) {
                // Redirect to backend for verification
                window.location.href = "/payment/callback?" +
                    "razorpay_order_id=" + response.razorpay_order_id +
                    "&razorpay_payment_id=" + response.razorpay_payment_id +
                    "&razorpay_signature=" + response.razorpay_signature +
                    "&order_id=" + "{{ $order_id }}";
            },
            "theme": {
                "color": "#3399cc"
            }
        };

        var rzp = new Razorpay(options);
        document.getElementById('pay-btn').onclick = function(e){
            rzp.open();
            e.preventDefault();
        };
    </script>
</body>
</html>
