<!DOCTYPE html>
<html>
<head>
    <title>New Instructor Registered on CodePilot</title>
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
            background-color: #dc3545; /* CodePilot red */
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
        .content ul {
            list-style-type: none;
            padding: 0;
        }
        .content ul li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-size: 16px;
        }
        .content ul li:last-child {
            border-bottom: none;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 20px;
            background-color: #dc3545; /* CodePilot red */
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #bb2d3b; /* Darker red on hover */
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
            .header {
                font-size: 20px;
            }
            .btn {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        New Instructor Registered on CodePilot!
    </div>

    <div class="content">
        <p>A new instructor has been registered on the CodePilot platform:</p>
        <ul>
            <li><strong>Username:</strong> {{ $user->username }}</li>
            <li><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</li>
            <li><strong>Email:</strong> {{ $user->email }}</li>
            <li><strong>Phone:</strong> {{ $user->phone_number }}</li>
        </ul>
        <p>Please review their profile in the admin panel.</p>
        <a href="{{ route('instructorList') }}" class="btn">View Instructor</a>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} CodePilot. All Rights Reserved.
    </div>
</div>

</body>
</html>
