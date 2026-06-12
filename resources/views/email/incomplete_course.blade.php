<!DOCTYPE html>
<html>
<head>
    <title>Incomplete Course Reminder</title>
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
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #dc3545;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        ul {
            padding-left: 20px;
        }
        li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        Incomplete Course Reminder
    </div>

    <div class="content">
        <p>Dear Learner,</p>
        <p>You have incomplete courses that need your attention:</p>

        <ul>
            @foreach ($coursesList as $course)
                <li>
                    {{ $course['course_title'] }}
                    {{-- <a href="{{ route('course.show', $course['course_id']) }}" class="btn">Resume Course</a> --}}
                </li>
            @endforeach
        </ul>

        <p>We encourage you to complete these courses to enhance your learning!</p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} CodePilot. All rights reserved.
    </div>
</div>

</body>
</html>
