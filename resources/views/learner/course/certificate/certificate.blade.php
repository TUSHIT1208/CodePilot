<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Appreciation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?abstract,luxury') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .certificate {
            width: 80%;
            max-width: 900px;
            background: white;
            padding: 50px;
            text-align: center;
            border: 15px solid gold;
            border-radius: 10px;
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .certificate h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        .certificate h3 {
            color: #c59d5f;
            font-weight: bold;
        }

        .certificate p {
            font-size: 1.1rem;
            margin-top: 20px;
            color: #555;
        }

        .name {
            font-size: 1.8rem;
            font-weight: bold;
            margin-top: 20px;
            text-transform: uppercase;
        }

        .gold-seal {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 100px;
            height: 100px;
            background: gold;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .signature {
            margin-top: 30px;
            font-style: italic;
            border-top: 2px solid black;
            display: inline-block;
            width: 250px;
            padding-top: 5px;
            font-weight: bold;
        }

        .date {
            margin-top: 20px;
            font-size: 1rem;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="certificate">
        @if($certificate)
            <p class="date">Awarded on: {{$certificate->created_at}}</p>
            <div class="gold-seal">Award</div>
            <h1>Certificate of Achievement</h1>
            <h3>Presented To</h3>
            <div class="name">{{ $certificate->name }}</div>
            <p>In recognition of outstanding performance, dedication, and achievement in {{ $tname }}.</p>
            <p>We extend our sincere appreciation for your hard work and commitment to excellence.</p>
            <div class="signature">Authorized Signature</div>
        @endif
    </div>
</body>

</html>
