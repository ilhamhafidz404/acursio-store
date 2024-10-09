<?php

namespace App\Http\Controllers;

use App\Models\SellingAccount;
use App\Models\TransactionAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TransactionAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactionAccounts= TransactionAccount::with("SellingAccount")->latest()->paginate(9);

        return response()->json([
            "code" => "ACSO-001",
            "success" => true,
            "message" => "success",
            "result" => $transactionAccounts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $invoice)
    {

        function showDecryptedData($id)
        {
            $sellingAccount = SellingAccount::findOrFail($id);

            $decryptedEmail = Crypt::decryptString($sellingAccount->email_account);
            $decryptedPassword = Crypt::decryptString($sellingAccount->password_account);

            return [
                'decryptedEmail' => $decryptedEmail,
                'decryptedPassword' => $decryptedPassword
            ];
        }

        
        $transactionAccount = TransactionAccount::with("SellingAccount")->whereInvoice($invoice)->first();

        // $decryptedAccountData = showDecryptedData($transactionAccount->id);

        // return response()->json($transactionAccount);
        return response()->json([
            "code" => "ACSO-001",
            'success' => true,
            'result' => $transactionAccount,
            'message' => 'Berhasil Get By Order ID Transaksi Akun'
        ], 201);




        // $mailTo = $request->userData["email"];
        // $accountStore = $request->accountStore;

        // Mail::to($mailTo)->send(new SendEmailSuccessBuyAccount([
        //     'title' =>  $accountStore["title"],
        //     'price' =>  $accountStore["price"],
        //     'rank' =>  $accountStore["rank"],
        //     'email' =>  $decryptedAccountData["decryptedEmail"],
        //     'password' =>  $decryptedAccountData["decryptedPassword"],
        // ]));

        // SellingAccount::find($request->accountStore["id"])->update([
        //     "status" => "sold out"
        // ]);

        // return response()->json([
        //     "code" => "ACSO-001",
        //     'success' => true,
        //     'result' => [
        //         "email" => $decryptedAccountData["decryptedEmail"],
        //         "password" => $decryptedAccountData["decryptedPassword"],
        //     ],
        //     'message' => 'Berhasil Beli Akun'
        // ]);

        // return response()->json([
        //     "code" => "ACSO-001",
        //     "success" => true,
        //     "message" => "success",
        //     "result" => $transactionAccount,
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
