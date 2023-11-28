<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;



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
Route::post('testing',function(){
    return 'test api works';
});

Route::post('/auth/register', [AuthController::class, 'createUser']);

Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::delete('users/{user}', [AuthController::class, 'destroy']);
Route::put('users/{user}', [AuthController::class, 'update']);

Route::middleware(['auth:sanctum','ability:admin'])->group(function(){

Route::post('/uploadfood', [AdminController::class, 'store']);
Route::delete("/deleteFood/{id}", [AdminController::class, 'deleteFood']);
Route::put('/updatefood/{id}', [AdminController::class, 'updateFood']);
Route::get('/food', [AdminController::class, 'getfood']);

});

