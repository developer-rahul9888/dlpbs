<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::any('/', [AdminController::class, 'login']);
Route::any('hr80c4037/login', [AdminController::class,'login']);
Route::group(['middleware'=>['admin_auth']], function() {
    Route::any('dashboard', [AdminController::class,'index']);
    Route::any('user-list', [AdminController::class,'userList']);
    Route::any('user/edit/{id}', [AdminController::class,'userEdit']);
    Route::any('bank-details', [AdminController::class, 'bankDetails']);
    Route::any('bank-detail/del/{id}', [AdminController::class, 'bankDetailDel']);
    Route::any('redeem-request', [AdminController::class, 'redeemRequestList']);
    Route::any('redeem-request/edit/{id}', [AdminController::class, 'redeemRequestEdit']);
    Route::any('send-money/{id}', [AdminController::class, 'redeemSendMoney']);
    Route::any('fund-request', [AdminController::class,'fundRequestList']);
    Route::any('fund-request/edit/{id}', [AdminController::class,'fundRequestEdit']);
    Route::any('add-fund', [AdminController::class,'addFund']);
    Route::any('purchase-list', [AdminController::class,'purchaseList']);
    Route::any('transfer-history', [AdminController::class,'transferHistory']);
    Route::any('universal-pool/{pool?}', [AdminController::class,'universalPool']);
    Route::any('member-login', [AdminController::class,'memberLogin']);
    Route::any('trustee-club-distribution', [AdminController::class,'trusteeClubDistribution']);
    Route::any('closing', [AdminController::class,'closing']);
    Route::any('payouts', [AdminController::class,'payouts']);
    Route::any('roi-list', [AdminController::class,'roiList']);

    Route::any('level-income', [AdminController::class,'levelIncome']);
    Route::any('roi-income', [AdminController::class,'roiIncome']);
    Route::any('direct', [AdminController::class,'direct']);
    Route::any('team', [AdminController::class,'team']);
    Route::any('activate-package', [AdminController::class,'activatePackage']);
    //Route::any('/fund-request', [AdminController::class, 'fundRequest']);
    Route::any('fund-history', [AdminController::class,'fundHistory']);
    Route::any('logout', [AdminController::class,'logout']);
});
