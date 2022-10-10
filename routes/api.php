<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;

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



Route::group(['prefix' => 'v1'], function () {
    // auth
    Route::group([
        'middleware' => 'api',
        'namespace' => 'App\Http\Controllers',
        'prefix' => 'auth'
    ], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
        Route::post('register', [AuthController::class, 'register']);
    });

    Route::group(['prefix' => 'team'], function () {
        Route::post('create', [TeamController::class, 'create']);
        Route::put('edit', [TeamController::class, 'edit']);
        Route::delete('delete', [TeamController::class, 'delete']);
    });
});

// route sin permisos
route::get('login', function () {
    return response()->json('Usuario sin permisos', 400);
})->name('login');
