<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Models\Food;
use App\Models\Foodchef;

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
Route::get('/', function () {
    $chef = Foodchef::orderBy('id') 
    ->take(3)                    
    ->get();
    $food = Food::where('category', 'food')
    ->orderBy('id') 
    ->take(7)       
    ->get();

    return view('welcome',compact('food','chef'));
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get("/search",[AdminController::class,'search']);

    Route::get("/foodmenu",[AdminController::class, 'foodmenu'])->name('foodmenu');
    Route::post('/uploadfood', [AdminController::class, 'store'])->name('uploadfood');
    Route::get("/deleteFood/{id}",[AdminController::class,"deleteFood"]);
    Route::post('/updatefood', [AdminController::class, 'updateFood'])->name('updatefood');
    Route::get('/getBranchFood/{branch}', [AdminController::class, 'getBranchFood'])->name('getBranchFood');


    Route::get("/chefview",[AdminController::class, 'chefview']);
    Route::post('/uploadchef', [AdminController::class, 'storechef'])->name('uploadchef');
    Route::get("/deleteChef/{id}",[AdminController::class,"deleteChef"]);
    Route::post('/updatechef', [AdminController::class, 'updatechef'])->name('updatechef');

});
Route::middleware('auth')->group(function () {
        Route::get('/user/settings', 'App\Http\Controllers\SettingController@settings')->name('user.settings');
        Route::post("/changePassword/{id}",[AdminController::class,"changePassword"])->name('change-password');
        Route::put('/profile', [AdminController::class,"updatep"])->name('updatep');
        Route::delete('/delete-profile', [AdminController::class,"deleteProfile"])->name('delete.profile');

});


Route::middleware(['user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/cart', [UserController::class, 'cart'])->name('user.cart')->middleware('auth');//logged in user go to cart age or direct ogin page
    Route::post('/add-to-cart', [UserController::class, 'addToCart'])->name('user.add_to_cart');
    Route::get('/cartitem', [UserController::class, 'cartitem'])->name('cartitem');
    Route::delete('/cart/remove/{cartItem}', [UserController::class, 'removeCartItem'])->name('cart.remove');
    Route::get('/history', [UserController::class, 'history'])->name(' history')->middleware('auth');
    Route::delete('/user/delete-purchase/{purchaseId}', [UserController::class, 'deletePurchase'])->name('user.delete_purchase');
    Route::post("/reservation",[UserController::class, 'reservation'])->middleware('auth');



});

Route::get('/stripe/{totalprice}', [UserController::class, 'stripe']);

Route::post('stripe/{totalprice}', [UserController::class,'stripePost'])->name('stripe.post');



