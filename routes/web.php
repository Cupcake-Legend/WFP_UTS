<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ReportController;
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


//ROUTE yang bisa diakses SEMUA
Route::get("/", [MenuController::class, "index"])->name("index");
Route::get('/info', function () {
    return view('information');
});
Route::get('/nutrition', function () {
    return view('nutrition');
});



// ROUTE KHUSUS yang belum LOGIN !! -cupcake legend
Route::middleware("guest")->group(function () {

    Route::get("/register", [UserController::class, "create"])->name("register");

    Route::get("/login", [UserController::class, "loginView"])->name("login");
    Route::post("/login", [UserController::class, "login"])->name("loginAttempt");
});

Route::middleware("auth")->group(function () {
    Route::post("/logout", [UserController::class, "logout"])->name("logout");
});

// ROUTE KHUSUS ADMIN !! -cupcake legend
Route::middleware("auth:admin")->group(function () {
    Route::get("/users/index", [UserController::class, "index"])->name("users.index");
});









Route::resource("users", UserController::class)->except("create");


Route::resource("paymentMethods", PaymentMethodController::class);

Route::resource("categories", CategoryController::class);

Route::resource("notifications", NotificationController::class);

Route::resource("rewards", RewardController::class);

Route::resource("rewardDetails", RewardDetailController::class);

Route::resource("orders", OrderController::class);

Route::resource("orderDetails", OrderDetailController::class);

Route::resource("menus", MenuController::class)->except("index");


Route::get('/order', function () {
    return view('order');
});
Route::get('/pay', function () {
    return view('payment');
});

Route::get('/filter-category', [MenuController::class, 'filterCategory']);
//});


Route::prefix('reports')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/most-food-category', [ReportController::class, 'mostFoodCategory'])->name('reports.mostFoodCategory');
    Route::get('/highest-avg-price-category', [ReportController::class, 'highestAvgPriceCategory'])->name('reports.highestAvgPriceCategory');
    Route::get('/menu-count-per-category', [ReportController::class, 'menuCountPerCategory'])->name('reports.menuCountPerCategory');
    Route::get('/most-expensive-and-cheapest', [ReportController::class, 'mostExpensiveAndCheapestMenu'])->name('reports.mostExpensiveAndCheapest');
    Route::get('/avg-price-per-category', [ReportController::class, 'avgPricePerCategory'])->name('reports.avgPricePerCategory');
});
