<!DOCTYPE html>
<html>
<head>
    <title>New Course Purchased</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: 1px solid #ddd;
        }
        .header {
            background-color: #dc3545;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        New Course Purchased!
    </div>

    <div class="content">
        <p>A new course has been purchased by:</p>
        <ul>
            <li><strong>Name:</strong> {{ $learner->first_name }} {{ $learner->last_name }}</li>
            <li><strong>Email:</strong> {{ $learner->email }}</li>
            <li><strong>Course:</strong> {{ $course->title }}</li>
            <li><strong>Course Price:</strong> ₹{{ number_format($course->price, 2) }}</li>
            <li><strong>Discount:</strong> ₹{{ number_format($course->discount ?? 0, 2) }}</li>
            <li><strong>Final Price:</strong> ₹{{ number_format($course->final_price, 2) }}</li>

        </ul>
        <p>Please check panel for more details.</p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} CodePilot. All rights reserved.
    </div>
</div>

</body>
</html>
