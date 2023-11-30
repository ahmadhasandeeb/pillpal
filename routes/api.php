<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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


Route::middleware('ApiLocalize')->group(function () {
    /* ----------------- Authentication Routes ----------------- */
    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::middleware('auth:api')->group(function () {
        Route::get('logout', [AuthController::class,'logout']);
    /* ----------------- Order Routes ----------------- */
        Route::group(['prefix'=> 'orders'], function () {
            Route::post('add', [OrderController::class,'createOrder']);
            Route::get('list', [OrderController::class,'userOrders']);
            Route::get('detail', [OrderController::class,'orderDetails']);
            Route::delete('delete', [OrderController::class,'deleteOrder']);
        });
        //----------------Company Routes--------------------------
        Route::group(['prefix'=>'companies'],function(){
            Route::get('detail',[CompanyController::class,'company']);
            Route::get('list',[CompanyController::class,'companies']);
            Route::get('home',[CompanyController::class,'companyForHome']);
        });
        /* ----------------- Profile Routes ----------------- */
        Route::group(['prefix'=> 'profile'], function () {
            Route::post('edit', [ProfileController::class,'editInfo']);
            Route::get('get', [ProfileController::class,'getInfo']);
            Route::post('set-image', [ProfileController::class,'setImage']);
            Route::delete('delete-image', [ProfileController::class,'deleteImage']);
            Route::post('change-password', [ProfileController::class,'changePassword']);
        });
    });
});

