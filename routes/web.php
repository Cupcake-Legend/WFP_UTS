<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\RewardDetailController;
use App\Http\Controllers\UserController;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\RewardDetail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// ill do this later - cupcakelegend
Route::get('/info', function () {
    return view('information');
});
Route::get('/nutrition', function () {
    return view('nutrition');
});
Route::get('/order', function () {
    return view('order');
});
Route::get('/pay', function () {
    return view('payment');
});


//Route::middleware(["auth"])->group(function () {

Route::get("register", [UserController::class, "create"])->name("register");

Route::get("/", [MenuController::class, "index"]);

Route::resource("users", UserController::class)->except("create");

Route::resource("menus", MenuController::class)->except("index");

Route::resource("paymentMethods", PaymentMethodController::class);

Route::resource("categories", CategoryController::class);

Route::resource("notifications", NotificationController::class);

Route::resource("rewards", RewardController::class);

Route::resource("rewardDetails", RewardDetailController::class);

Route::resource("orders", OrderController::class);

Route::resource("orderDetails", OrderDetailController::class);
//});
