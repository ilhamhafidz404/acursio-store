<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome to Our Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f1f1;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }

        .message {
            padding: 20px;
            background-color: #ffffff;
        }

        .message p {
            margin-bottom: 10px;
        }

        .message table {
            margin-left: 15px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        
        <div class="message">
            <p>Dear Customer</p>
            <p>Silahkan selesaikan proses pembelian akun <b>{{ $mailData['title'] }}</b> dengan harga Rp {{ number_format($mailData['price'], 0, ',', '.') }} pada link berikut</p>

            <a href={{$mailData["paymentLink"]}}>{{ $mailData["paymentLink"] }}</a>
        </div>
        
    </div>
</body>

</html>