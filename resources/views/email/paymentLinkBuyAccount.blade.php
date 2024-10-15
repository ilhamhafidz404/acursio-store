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
            <img src={{asset("/logo.webp")}} width="70" />
            <p>Dear Customer</p>
            <br>
            <p>
                Terima kasih telah memilih untuk membeli akun <b>{{ $mailData['title'] }}</b>. 
                Silakan selesaikan proses pembayaran dengan total sebesar <b>Rp {{ number_format($mailData['price'], 0, ',', '.') }}</b> melalui tautan berikut:
            </p>

            <p>
                <a href="{{ $mailData['paymentLink'] }}">{{ $mailData['paymentLink'] }}</a>
            </p>

            <p>
                Jika Anda memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi kami. Terima kasih atas kepercayaan Anda kepada kami.
            </p>

            <br><br><br>
            <p>Salam hangat, <br><br><b>Tim Acursio Store</b></p>

        </div>
        
    </div>
</body>

</html>