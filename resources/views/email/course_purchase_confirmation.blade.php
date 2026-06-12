<!DOCTYPE html>
<html>
<head>
    <title>Course Purchase Confirmation</title>
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
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #dc3545;
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            text-align: center;
            cursor: pointer;
            border: none;
        }
        .btn:hover {
            background-color: #bb2d3b;
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
        Course Purchase Confirmation
    </div>

    <div class="content">
        <p>Dear {{ $learner->first_name }},</p>
        <p>Thank you for purchasing the course <strong>{{ $course->title }}</strong>.</p>
        <p>You can now start learning and exploring the course content!</p>

        <a href="{{ route('course.show', $course->id) }}" class="btn">Start Course</a>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} CodePilot. All rights reserved.
    </div>
</div>

</body>
</html>
