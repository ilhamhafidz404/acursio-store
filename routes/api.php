<?php

use App\Http\Controllers\BuyAccountController;
use App\Http\Controllers\CheckStatusTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\ResendEmailSuccessBuyAccount;
use App\Http\Controllers\SellingAccountController;
use App\Http\Controllers\TransactionAccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Dashboard
Route::get("/dashboard", DashboardController::class);

// JUBEL
Route::apiResource("/sellingAccounts", SellingAccountController::class);
Route::post("/buyAccount", BuyAccountController::class);
Route::apiResource("/transactionAccounts", TransactionAccountController::class);
Route::get("/checkStatusTransactions", CheckStatusTransactionController::class);
Route::post("/resendEmailSuccessBuyAccount", ResendEmailSuccessBuyAccount::class);
Route::post("/paymentCallback", PaymentCallbackController::class);
