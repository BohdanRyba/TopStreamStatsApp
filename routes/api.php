<?php

use App\Http\Controllers\Api\V1\Twitch\TwitchController as TwitchControllerV1;
use App\Http\Controllers\Api\V2\Twitch\TwitchController as TwitchControllerV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::middleware('auth:sanctum')->get('/streams', [TwitchControllerV1::class, 'getList']);
    });
    Route::prefix('v2')->group(function () {
        Route::middleware('auth:sanctum')->get('/streams', [TwitchControllerV2::class, 'getList']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
