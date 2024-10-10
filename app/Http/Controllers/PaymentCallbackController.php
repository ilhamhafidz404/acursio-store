<?php

namespace App\Http\Controllers;

use App\Models\TransactionAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentCallbackController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $transactionAccount = TransactionAccount::whereInvoice($request->order_id)->first();
        
            if (!$transactionAccount) {
                throw new Exception("Transaction account not found");
            }
        
            if ($request->transaction_status === "settlement") {
                $transactionAccount->update([
                    "updated_at" => $request->settlement_time,
                    "payment_type" => $request->payment_type,
                    "status" => "success"
                ]);
            } else if ($request->transaction_status === "pending") {
                $transactionAccount->update([
                    "updated_at" => $request->transaction_time,
                    "payment_type" => $request->payment_type,
                    "status" => "pending"
                ]);
            }
        
            return response()->json([
                "code" => "ACSO-001",
                "success" => true,
                "message" => "success",
                "result" => $request,
            ]);
        
        } catch (Exception $e) {
            Log::error('Transaction update failed: ' . $e->getMessage());
            
            return response()->json([
                "code" => "ACSO-003",
                "success" => false,
                "message" => "failed",
                "result" => [],
            ]);
        }
        
    }
}
