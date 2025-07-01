<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
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
// Route::get('/nutrition', function () {
//     return view('nutrition');
// });
Route::get('/nutrition', [MenuController::class, 'nutrition']);

Route::get('/filter-category', [MenuController::class, 'filterCategory']);

Route::resource("users", UserController::class)->except("create", "index");




// ROUTE KHUSUS yang belum LOGIN !! -cupcake legend
Route::middleware("guest")->group(function () {

    Route::get("/register", [UserController::class, "create"])->name("register");
    Route::post('/register', [UserController::class, 'register'])->name('registerAttempt');

    Route::get("/login", [UserController::class, "loginView"])->name("login");
    Route::post("/login", [UserController::class, "login"])->name("loginAttempt");
});

Route::middleware("auth")->group(function () {
    Route::post("/logout", [UserController::class, "logout"])->name("logout");
});

// ROUTE KHUSUS ADMIN !! -cupcake legend
Route::middleware(["auth", "role:admin"])->prefix("admin")->group(function () {

    //ADMIN
    Route::get("dashboard", [UserController::class, "admin"])->name("admin.dashboard");

    Route::post("/orders/finish", [OrderController::class, "updateStatus"])->name("orders.finish");

    //USERS
    Route::get("users", [UserController::class, "index"])->name("users.index");

    //CATEGORIES
    Route::resource("categories", CategoryController::class);

    //MENU
    Route::resource("menus", MenuController::class)->except("index");

    //PAYMENT METHODS
    Route::resource("paymentMethods", PaymentMethodController::class);


    Route::resource("rewards", controller: RewardController::class)->except("index");
    Route::resource("rewardDetails", RewardDetailController::class)->except("store");



    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/most-food-category', [ReportController::class, 'mostFoodCategory'])->name('reports.mostFoodCategory');
        Route::get('/highest-avg-price-category', [ReportController::class, 'highestAvgPriceCategory'])->name('reports.highestAvgPriceCategory');
        Route::get('/menu-count-per-category', [ReportController::class, 'menuCountPerCategory'])->name('reports.menuCountPerCategory');
        Route::get('/most-expensive-and-cheapest', [ReportController::class, 'mostExpensiveAndCheapestMenu'])->name('reports.mostExpensiveAndCheapest');
        Route::get('/avg-price-per-category', [ReportController::class, 'avgPricePerCategory'])->name('reports.avgPricePerCategory');
    });
});

//ROUTE KHUSUS USER!! -cupcake legend
Route::middleware(["auth", "role:user"])->group(function () {

    //utk orders sm orderdetails blm tk pikirin jg apa hanya user yg bisa akses atau admin apa ada akses apa -cupcake legend
    Route::resource("orders", OrderController::class);

    Route::resource("orderDetails", OrderDetailController::class);

    Route::post('/cart/add/{menu}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/checkout', [CartController::class, 'showCheckout'])->name('checkout');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('update.cart');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');


    Route::get('/reward', [RewardController::class, "index"])->name("reward.index");
    Route::post('/reward/claim/{rewardId}', [RewardController::class, "claimReward"])->name('reward.claim');
    Route::post('/reward-details/store', [RewardDetailController::class, 'store'])->name('reward_details.store');
    Route::get('/history', [OrderController::class, 'history'])->name('history');

    // Route::get('/order', function () {
    //     return view('order');
    // });
    Route::get('/pay', function () {
        return view('payment');
    });
});


