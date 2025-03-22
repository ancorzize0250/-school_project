<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)
        ->prefix('user')
        ->group(function() {
            Route::get('/', 'list');
            Route::get('/{detail}', 'detail');
            Route::post('/','create');
            Route::put('/{id}','update');
        });

    Route::controller(PersonController::class)
        ->prefix('person')
        ->group(function() {
            Route::get('/', 'list');
            Route::get('/{detail}', 'detail');
            Route::post('/','create');
            Route::put('/{id}','update');
        });
});