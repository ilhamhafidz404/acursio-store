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
            <p>Terima kasih telah mempercayakan pembelian akun Mobile Legends kamu di <b>Acursio Store</b>. Berikut kami sampaikan detail akun yang telah anda beli:</p>
            <table>
                <tr>
                    <td>Produk</td>
                    <td>:</td>
                    <td>
                        <b>{{ $mailData['title'] }}</b>
                    </td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>:</td>
                    <td>
                        <b>Rp {{ number_format($mailData['price'], 0, ',', '.') }}</b>
                    </td>
                </tr>
                <tr>
                    <td>Rank</td>
                    <td>:</td>
                    <td>
                        <b>{{ $mailData['rank'] }}</b>
                    </td>
                </tr>
            </table>

            <p>Untuk mengakses akun, Anda dapat login menggunakan email dan password dibawah ini : </p>

            <table>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>
                        <b>{{ $mailData['email'] }}</b>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td>
                        <b>{{ $mailData['password'] }}</b>
                    </td>
                </tr>
            </table>

            <p>Jika Anda mengalami kendala atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi tim kami melalui WhatsApp di nomor <b>083871352030</b>. Kami akan dengan senang hati membantu.</p>
            <p>Kami sangat menghargai kepercayaan Anda dan menantikan pembelian berikutnya di Acursio Store.</p>
            
            <br><br><br>
            <p>Salam hangat, <br><br><b>Tim Acursio Store</b></p>
        </div>
        
    </div>
</body>

</html>