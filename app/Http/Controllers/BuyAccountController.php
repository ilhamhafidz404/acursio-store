<?php

namespace App\Http\Controllers;

use App\Mail\SendPaymentLinkBuyAccount;
use App\Models\SellingAccount;
use App\Models\TransactionAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BuyAccountController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            // 
            $accountStore = $request->accountStore;
            $userData = $request->userData;

            // Check apakah selling account "available"
            $sellingAccount= SellingAccount::find($accountStore["id"]);

            if ($sellingAccount->status != "available") {
                abort(400, 'Selling account status is '. $sellingAccount->status);
            }
    
            // Set konfigurasi Midtrans
            \Midtrans\Config::$serverKey = config("midtrans.serverKey");
            \Midtrans\Config::$isProduction = config("midtrans.isProduction"); 
            \Midtrans\Config::$isSanitized = config("midtrans.isSanitized");
            \Midtrans\Config::$is3ds = config("midtrans.is3Ds");
    
            // Generate OrderID / INVOICE
            $datePart = Carbon::now()->format('Ymd');
            $uniquePart = Str::random(6);
            $orderID = 'ACS-' . $datePart . '.' . $uniquePart;
    
            // Siapkan parameter transaksi
            $params = [
                'transaction_details' => [
                    'order_id'      => $orderID, 
                    'gross_amount'  => $accountStore["price"], 
                ],
                "item_details" => [
                    [
                        "id"            => $accountStore["slug"],
                        'name'          => $accountStore["title"],
                        'price'         => $accountStore["price"],
                        'quantity'      => 1, 
                    ]
                ],
                "customer_details" => [
                    'phone'         => $userData["phone"],
                    'email'         => $userData["email"],
                ]
            ];
    
            // Buat Transaksi untuk Admin
            TransactionAccount::create([
                "invoice"               => $orderID,
                "selling_account_id"    => $accountStore["id"],
                "pay"                   => $accountStore["price"],
                "status"                => "pending",
                "user_email"            => $userData["email"],
                "user_phone"            => $userData["phone"]
            ]);
    
            // Ubah Selling Account menjadi in order
            SellingAccount::find($accountStore["id"])->update([
                "status" => "in order"
            ]);


            // Buat transaksi dan dapatkan URL pembayaran
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            // Send payment URL ke email user
            Mail::to($userData["email"])->send(new SendPaymentLinkBuyAccount([
                'title'         =>  $accountStore["title"],
                'price'         =>  $accountStore["price"],
                "paymentLink"   => $paymentUrl
            ]));
    
            // Kirim URL kembali sebagai respon JSON
            return response()->json(['payment_url' => $paymentUrl]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
