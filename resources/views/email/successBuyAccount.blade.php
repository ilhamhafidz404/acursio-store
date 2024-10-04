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
            <p>Terimakasih sudah membeli akun ML di <b>Acursio Store</b>. Berikut adalah rinciannya:</p>
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

            <p>Untuk melakukan login ke akun, silahkan gunakan email dan password berikut: </p>

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

            <p>Jika terdapat kesalahan atau kendala boleh dengan menghubungi admin kami di nomor WA <b>083871352030</b></p>
            <p>Kami tunggu pembelian anda selanjutnya.</p>
        </div>
        
    </div>
</body>

</html>