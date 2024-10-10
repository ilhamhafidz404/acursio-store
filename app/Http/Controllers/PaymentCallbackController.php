<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailSuccessBuyAccount;
use App\Models\SellingAccount;
use App\Models\TransactionAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
                // Update transaction status to success
                $transactionAccount->update([
                    "updated_at" => $request->settlement_time,
                    "payment_type" => $request->payment_type,
                    "status" => "success"
                ]);

                // Get decrypted data
                $sellingAccount = $this->showDecryptedData($transactionAccount->selling_account_id);

                // Send success email
                $this->sendSuccessEmail($transactionAccount, $sellingAccount);

                // Update selling account status to "sold out"
                SellingAccount::find($transactionAccount->selling_account_id)->update([
                    "status" => "sold out"
                ]);
            } elseif ($request->transaction_status === "pending") {
                // Update transaction status to pending
                $transactionAccount->update([
                    "updated_at" => $request->transaction_time,
                    "payment_type" => $request->payment_type,
                    "status" => "pending"
                ]);
            }

            // Return success response
            return response()->json([
                "code" => "ACSO-001",
                "success" => true,
                "message" => "success",
                "result" => $request,
            ]);

        } catch (Exception $e) {
            Log::error('Transaction update failed: ' . $e->getMessage());

            // Return error response
            return response()->json([
                "code" => "ACSO-003",
                "success" => false,
                "message" => "Transaction update failed",
                "result" => [],
            ], 500);
        }
    }

    /**
     * Decrypt the selling account data.
     */
    private function showDecryptedData($id)
    {
        $sellingAccount = SellingAccount::findOrFail($id);

        $decryptedEmail = Crypt::decryptString($sellingAccount->email_account);
        $decryptedPassword = Crypt::decryptString($sellingAccount->password_account);

        return [
            'title' => $sellingAccount->title,
            'rank' => $sellingAccount->rank,
            'decryptedEmail' => $decryptedEmail,
            'decryptedPassword' => $decryptedPassword
        ];
    }

    /**
     * Send the success email after settlement.
     */
    private function sendSuccessEmail($transactionAccount, $sellingAccount)
    {
        $mailTo = $transactionAccount->user_email;

        try {
            Mail::to($mailTo)->send(new SendEmailSuccessBuyAccount([
                'title' => $sellingAccount["title"],
                'price' => $transactionAccount->pay,
                'rank' => $sellingAccount["rank"],
                'email' => $sellingAccount["decryptedEmail"],
                'password' => $sellingAccount["decryptedPassword"],
            ]));
        } catch (Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
            throw new Exception("Failed to send email");
        }
    }

}
