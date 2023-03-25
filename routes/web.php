<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\ComparisonController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Shop\BusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CronJobController;
use App\Http\Controllers\RazorpayPaymentController;

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

//Route::get('/', function () { return view('welcome'); });

Route::get('/test', [ShopController::class, 'get_result'])->name('get_result');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('cron-job', [CronJobController::class, 'index'])->name('cron');
Route::any('response', [HomeController::class, 'response'])->name('response');
Route::get('how-it-work', [HomeController::class, 'howItWork'])->name('how-it-work');
Route::get('why-tether', [HomeController::class, 'whyTether'])->name('why-tether');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('services', [HomeController::class, 'services'])->name('services');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::any('member-login', [AuthController::class, 'member_login'])->name('member.login');
Route::any('login', [AuthController::class, 'login'])->name('login');
Route::any('register/{referral?}', [AuthController::class, 'register'])->name('register');
Route::any('payment', [AuthController::class, 'payment'])->name('payment');
Route::any('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');



Route::get('/product-details/{slug}', [ShopController::class, 'fetchProductDetails'])->name('shop.product');
Route::get('add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ShopController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ShopController::class, 'remove'])->name('remove.from.cart');
Route::get('product', [ShopController::class, 'product'])->name('product');
Route::get('points', [ShopController::class, 'points'])->name('points');
Route::get('product-test', [ShopController::class, 'product_test'])->name('product.test');
Route::get('category/{categoryId}', [ShopController::class, 'category'])->name('category');
Route::any('search/{keyword?}', [ShopController::class,'search'])->name('search');
Route::any('ajax-search/{keyword?}', [ShopController::class,'ajax_search'])->name('ajax.search');
Route::get('cart', [ShopController::class, 'cart'])->name('cart');
Route::get('cart-count', [ShopController::class, 'cartCount'])->name('cart.count');
Route::any('checkout', [ShopController::class, 'checkout'])->name('checkout');

Route::any('thankyou/{orderId}', [ShopController::class, 'thankyou'])->name('thankyou');
Route::any('order-tracking', [ShopController::class, 'order_tracking'])->name('order.tracking');

Route::any('pay/{orderId}', [ShopController::class, 'pay'])->name('pay');
Route::any('callback/{orderId}', [ShopController::class, 'callback'])->name('callback');


Route::any('online-store', [ShopController::class, 'onlineStore'])->name('online.store');
Route::any('online-store-search/{keyword?}', [ShopController::class, 'ajaxWebStoreSearch'])->name('online.store.search');
Route::any('redirecting/{storeId}', [ShopController::class, 'redirecting'])->name('online.redirecting');


Route::any('bus/search', [BusController::class, 'index'])->name('bus.search');
Route::any('bus/ajax-search/{keyword?}', [BusController::class,'ajax_search'])->name('bus.ajax.search');
Route::any('bus/list', [BusController::class, 'busList'])->name('bus.list');

Route::get('razorpay-payment', [RazorpayPaymentController::class, 'index']);
Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');
Route::any('username/{userId}', [AuthController::class, 'username']);

Route::group(['namespace' => 'User', 'prefix' => 'user','middleware' => 'auth'], function() {
    Route::any('/', [UserController::class, 'index'])->name('dashboard');
    Route::any('direct-income', [UserController::class, 'directIncome'])->name('income.direct');
    Route::any('level-income', [UserController::class, 'levelIncome'])->name('income.level');
    Route::any('basic-pool-income', [UserController::class, 'basicPoolIncome'])->name('income.basic.pool');
    Route::any('pro-pool-income', [UserController::class, 'proPoolIncome'])->name('income.pro.pool');
    Route::any('pro-binary-income', [UserController::class, 'proBinaryIncome'])->name('income.pro.binary');
    Route::any('master-pool-income', [UserController::class, 'masterPoolIncome'])->name('income.master.pool');
    Route::any('master-binary-income', [UserController::class, 'masterBinaryIncome'])->name('income.master.binary');
    Route::any('super-pool-income', [UserController::class, 'superPoolIncome'])->name('income.super.pool');
    Route::any('super-binary-income', [UserController::class, 'superBinaryIncome'])->name('income.super.binary');
    Route::any('super-fast-pool-income', [UserController::class, 'superFastPoolIncome'])->name('income.super.pool');
    Route::any('super-fast-binary-income', [UserController::class, 'superFastBinaryIncome'])->name('income.super.binary');
    Route::any('director-pool-income', [UserController::class, 'directorPoolIncome'])->name('income.director.pool');
    Route::any('director-binary-income', [UserController::class, 'directorBinaryIncome'])->name('income.director.binary');
    Route::any('salary-income', [UserController::class, 'salaryIncome'])->name('income.salary');
    Route::any('weekly-fix-income', [UserController::class, 'weeklyFixIncome'])->name('income.weekly');
    Route::any('income', [UserController::class, 'income'])->name('income');
    Route::any('roi-list', [UserController::class, 'roiList'])->name('roi');
    Route::any('direct', [UserController::class, 'direct'])->name('admin.direct');
    Route::any('team', [UserController::class, 'team'])->name('admin.team');
    Route::any('team-binary', [UserController::class, 'teamBinary'])->name('admin.team.binary');
    Route::any('treeview/{customerId?}', [UserController::class, 'treeview'])->name('admin.team.treeview');
    Route::any('pool/{poolType}/{customerId?}', [UserController::class, 'treeviewPool'])->name('admin.treeview.pool');
    Route::any('level-team/{level?}', [UserController::class, 'levelTeam'])->name('admin.team.level');
    Route::any('activation', [UserController::class, 'activation'])->name('admin.activation');
    Route::any('activate-account', [UserController::class, 'activateAccount'])->name('admin.activate.account');
    Route::any('activate-user', [UserController::class, 'activateUser'])->name('admin.activate.user');
    Route::any('activate-pool', [UserController::class, 'activatePool'])->name('admin.activate.pool');
    Route::any('redeem', [UserController::class, 'redeem'])->name('admin.redeem');
    Route::any('fund-request/add', [UserController::class, 'fundRequestAdd'])->name('admin.fund.request');
    Route::any('load-fund', [UserController::class, 'loadFund'])->name('admin.load.fund');
    Route::any('load-fund/{paymentId}', [UserController::class, 'loadFundVerify'])->name('admin.fund.verify');
    Route::any('transfer-fund', [UserController::class, 'transferFund'])->name('admin.transfer.fund');
    Route::any('fund-request', [UserController::class, 'fundRequest'])->name('admin.fund.request');
    Route::any('fund-history', [UserController::class, 'fundHistory'])->name('admin.fund.history');
    Route::any('profile/edit', [UserController::class, 'profileEdit'])->name('profile.edit');
    Route::any('brainsecret', [UserController::class, 'brainsecret'])->name('brainsecret');
    Route::any('kyc/edit', [UserController::class, 'kycEdit'])->name('kyc.edit');
    Route::any('bank/edit', [UserController::class, 'bankEdit'])->name('bank.edit');
    Route::any('bank/verify', [UserController::class, 'bankVerify'])->name('bank.verify');
    Route::any('bank/verify/otp', [UserController::class, 'bankVerify'])->name('bank.verify');
    Route::any('password', [UserController::class, 'password'])->name('password');



    Route::any('/orders', [UserController::class, 'orders'])->name('orders');
    Route::any('/invoice/{invoiceId}', [UserController::class, 'invoice'])->name('invoice');
    Route::any('/address', [UserController::class, 'address'])->name('address');
    Route::any('/payment', [UserController::class, 'payment'])->name('payment');
    Route::any('/wishlist', [UserController::class, 'wishlist'])->name('wishlist');
    Route::any('/security', [UserController::class, 'security'])->name('security');
    Route::any('/order/{orderId}', [UserController::class, 'order_view'])->name('order.view');
    Route::any('/profile', [UserController::class, 'profile'])->name('profile');
    
    
    
    Route::any('/password', [UserController::class, 'password'])->name('profile.password');
    Route::any('/logout', [UserController::class, 'logout'])->name('logout');
});
