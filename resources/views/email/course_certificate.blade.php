<!DOCTYPE html>
<html>
<head>
    <title>Course Completion Certificate</title>
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
            background-color: #4CAF50;
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
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4CAF50;
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
            background-color: #45a049;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        .test-result {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
        }
        .test-result h3 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #4CAF50;
        }
        .test-result p {
            margin: 5px 0;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        Course Completion Certificate
    </div>

    <div class="content">
        <p>Dear {{ auth()->user()->first_name }},</p>
        <p>Congratulations on completing the course!</p>
        <p>Your certificate is attached to this email. Keep up the great work!</p>

        <!-- ✅ Test Result Section -->
        @if($test_result)
        <div class="test-result">
            <h3>Your Test Result:</h3>
            <p><strong>Correct Answers:</strong> {{ $test_result->total_correct_answer }}</p>
            <p><strong>Wrong Answers:</strong> {{ $test_result->total_wrong_answer }}</p>
            <p><strong>Total Attempted:</strong> {{ $test_result->total_attempted }}</p>
            <p><strong>Overall Score:</strong> {{ $test_result->overall_score }}%</p>
        </div>
        @endif

        {{-- <a href="{{ route('course.show', $certificate->course_id) }}" class="btn">View Course</a> --}}
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} CodePilot. All rights reserved.
    </div>
</div>

</body>
</html>
