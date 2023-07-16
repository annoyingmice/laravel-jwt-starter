<?php

use App\Http\Controllers\Api\v1\AuthController;
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

Route::namespace('Api\v1')
    ->prefix('v1')
    ->group(function () {
        Route::prefix('auth')
            ->group(function () {
                Route::post('user', [AuthController::class, 'user']);
                Route::post('admin', [AuthController::class, 'admin']);
            });
    });

Route::get('healthcheck', fn () => response()->json(['ok' => true], 200));
