<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Route::post('/login', [AuthController::class, 'login']);
//Route::post('/register', [AuthController::class, 'createUser']);
//Route::post('/change-password', [AuthController::class, 'changePassword']);

Route::controller(UserController::class)
    ->prefix('user')
    ->group(function() {
        Route::get('/', 'list');
        Route::get('/{detail}', 'detail');
        Route::post('/','create');
        Route::put('/{id}','update');
    });