<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailSuccessBuyAccount;
use App\Models\SellingAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BuyAccountController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $mailTo = $request->userData["email"];
        $accountStore = $request->accountStore;

        Mail::to($mailTo)->send(new SendEmailSuccessBuyAccount([
            'title' =>  $accountStore["title"],
            'price' =>  $accountStore["price"],
            'rank' =>  $accountStore["rank"],
            'email' =>  $accountStore["email_account"],
            'password' =>  $accountStore["password_account"],
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
