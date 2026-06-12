<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to CodePilot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }
        .header {
            background-color: red;
            color: #ffffff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }
        .btn-custom {
            background-color:  red;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 15px;
        }
        .btn-custom:hover {
            background-color:  red;
            color: #ffffff;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Welcome to CodePilot 🎉</h2>
        </div>
        <div class="content">
            <h3>Hello, {{ $user->username }}! 👋</h3>
            <p>We're absolutely thrilled to have you on board. At <strong>CodePilot</strong>, we strive to provide you with the best experience possible.</p>
            <p>Feel free to explore your dashboard, connect with others, and make the most out of our amazing features.</p>
        </div>
    </div>

</body>
</html>
