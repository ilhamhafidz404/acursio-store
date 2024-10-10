<?php

namespace App\Http\Controllers;

use App\Models\SellingAccount;
use App\Models\TransactionAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $todayTransactionCount = TransactionAccount::whereDate('created_at', Carbon::today())->count();
        $yesterdayTransactionCount = TransactionAccount::whereDate('created_at', Carbon::yesterday())->count();


        if ($yesterdayTransactionCount > 0) {
            $percentageChange = (($todayTransactionCount - $yesterdayTransactionCount) / $yesterdayTransactionCount) * 100;
        } else {
            $percentageChange = $todayTransactionCount > 0 ? 100 : 0;
        }

        $todaySellingAccountCount = SellingAccount::whereStatus('available')->count();

        return response()->json([
            "code" => "ACSO-001",
            "success" => true,
            "message" => "success",
            "result" => [
                "todayTransaction" => $todayTransactionCount,
                "yesterdayTransactionCount" => $yesterdayTransactionCount,
                "percentationTransaction" => $percentageChange,
                "todaySellingAccount" => $todaySellingAccountCount,
            ],
        ]);
    }
}
