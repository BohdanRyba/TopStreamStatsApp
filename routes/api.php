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
        Route::get('/streams', [TwitchControllerV1::class, 'getStreams']);
        Route::get('/viewers', [TwitchControllerV1::class, 'getViewers']);
        Route::get('/medians', [TwitchControllerV1::class, 'getMedians']);
        Route::get('/even', [TwitchControllerV1::class, 'getEvenStreams']);
        Route::get('/odds', [TwitchControllerV1::class, 'getOddStreams']);
        Route::get('/same', [TwitchControllerV1::class, 'getSameStreams']);
        Route::get('/top', [TwitchControllerV1::class, 'getTopStreams']);
    });
    Route::prefix('v2')->group(function () {
        Route::get('/streams', [TwitchControllerV2::class, 'getStreams']);
        Route::get('/viewers', [TwitchControllerV2::class, 'getViewers']);
        Route::get('/medians', [TwitchControllerV2::class, 'getMedians']);
        Route::get('/even', [TwitchControllerV2::class, 'getEvenStreams']);
        Route::get('/odds', [TwitchControllerV2::class, 'getOddStreams']);
        Route::get('/same', [TwitchControllerV2::class, 'getSameStreams']);
        Route::get('/top', [TwitchControllerV2::class, 'getTopStreams']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
