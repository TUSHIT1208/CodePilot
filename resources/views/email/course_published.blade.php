<!DOCTYPE html>
<html>
<head>
    <title>{{ $isCreator ? 'Your Course is Published!' : 'New Course Published' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
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
        }
        .header {
            background-color: #dc3545;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
            font-size: 16px;
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
            text-align: center;
            cursor: pointer;
            border: none;
        }
        .btn:hover {
            background-color: #c82333;
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
        {{ $isCreator ? 'Your Course is Published!' : 'New Course Published!' }}
    </div>

    <div class="content">
        @if ($isCreator)
            <p>Hi {{ $course->user->first_name }},</p>
            <p>Your course <strong>{{ $course->title }}</strong> has been successfully published!</p>
            <p>You can now see it live on the platform.</p>
            <a href="{{ route('course.show', $course->id) }}" class="btn">View Course</a>
        @else
            <p>A new course <strong>{{ $course->title }}</strong> has been published!</p>
            <p>You can now explore the course content and start learning.</p>
            <a href="{{ route('course.show', $course->id) }}" class="btn">Start Course</a>
        @endif
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} CodePilot. All rights reserved.
    </div>
</div>

</body>
</html>
