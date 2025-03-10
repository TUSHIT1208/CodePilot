{{-- <!-- resources/views/learner/course/certificate/certificate.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate</title>
</head>

<body>
    <h1>Certificate of Completion</h1>

    <p>Dear {{ Auth::user()->name }},</p>

    <p>Congratulations on completing the following courses:</p>

    <ul>
        @foreach($certificate as $cert)
        <li>{{ $cert->test_id }} - {{ $cert->name }}</li>
        @endforeach
    </ul>

    <p>Thank you for your dedication!</p>
</body> --}}

{{--

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Appreciation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .certificate {
            width: 80%;
            max-width: 900px;
            background: white;
            padding: 40px;
            text-align: center;
            border: 10px solid gold;
            border-radius: 10px;
            position: relative;
        }

        .certificate h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #0d1b2a;
        }

        .certificate h3 {
            color: gold;
            font-weight: bold;
        }

        .certificate p {
            font-size: 1rem;
            margin-top: 20px;
        }

        .name {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 20px;
        }

        .badge {
            position: absolute;
            left: 20px;
            bottom: 20px;
            background: red;
            color: white;
            padding: 10px 20px;
            border-radius: 50%;
            font-weight: bold;
        }

        .gold-seal {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 80px;
            height: 80px;
            background: gold;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .signature {
            margin-top: 30px;
            font-style: italic;
            border-top: 1px solid black;
            display: inline-block;
            width: 200px;
            padding-top: 5px;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="certificate">
            @if($certificate)
                <div class="gold-seal">Award</div>
                <h1>CERTIFICATE</h1>
                <h3>OF ACHIEVEMENT</h3>
                <h1>WORD PRESS </h1>
                <p>THIS CERTIFICATE IS PROUDLY PRESENTED TO</p>
                <div class="name">{{ $certificate->name }}</div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.</p>
                <p>hello</p>
                <div class="signature">Signature</div>
                <div class="badge">2020</div>
            @endif
        </div>
    </div>
</body>

</html>