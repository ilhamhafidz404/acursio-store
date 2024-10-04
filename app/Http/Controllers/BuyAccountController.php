<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailSuccessBuyAccount;
use App\Models\SellingAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class BuyAccountController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        function showDecryptedData($id)
        {
            // Ambil data selling_account berdasarkan ID atau slug
            $sellingAccount = SellingAccount::findOrFail($id);

            // Dekripsi kolom email_account dan password_account
            $decryptedEmail = Crypt::decryptString($sellingAccount->email_account);
            $decryptedPassword = Crypt::decryptString($sellingAccount->password_account);

            // Return array yang berisi kedua variabel
            return [
                'decryptedEmail' => $decryptedEmail,
                'decryptedPassword' => $decryptedPassword
            ];
        }

        $decryptedAccountData = showDecryptedData($request->accountStore["id"]);



        $mailTo = $request->userData["email"];
        $accountStore = $request->accountStore;

        Mail::to($mailTo)->send(new SendEmailSuccessBuyAccount([
            'title' =>  $accountStore["title"],
            'price' =>  $accountStore["price"],
            'rank' =>  $accountStore["rank"],
            'email' =>  $decryptedAccountData["decryptedEmail"],
            'password' =>  $decryptedAccountData["decryptedEmail"],
        ]));

        SellingAccount::find($request->accountStore["id"])->update([
            "status" => "sold out"
        ]);

        return response()->json([
            "code" => "ACSO-001",
            'success' => true,
            'result' => [],
            'message' => 'Berhasil Beli Akun'
        ]);
    }
}
