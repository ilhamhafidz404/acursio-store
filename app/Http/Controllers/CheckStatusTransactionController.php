<?php

namespace App\Http\Controllers;

use App\Models\SellingAccount;
use App\Models\TransactionAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckStatusTransactionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $transactionAccounts = 
            TransactionAccount::where('status', 'pending')
                ->where('created_at', '<=', Carbon::now()->subDay())
                ->get();

        foreach ($transactionAccounts as $transactionAccount) {
            SellingAccount::find($transactionAccount->selling_account_id)->update([
                "status" => "available"
            ]);

            TransactionAccount::find($transactionAccount->id)->update([
                "status" => "failed"
            ]);
        }

        return response()->json([
            "code" => "ACSO-001",
            "success" => true,
            "message" => "success update status " . $transactionAccounts->count() . " transaction",
            "result" => $transactionAccounts,
        ]);
    }
}
