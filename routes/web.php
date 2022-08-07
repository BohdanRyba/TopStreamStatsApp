<?php

use App\Http\Controllers\Api\Twitch\TwitchService;
use App\Http\Controllers\Oauth\Socialize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('test', [TwitchService::class, 'getList'])->name('twitch.streams');
Route::get('/auth/{driver}/redirect', [Socialize::class, 'redirect'])->name('auth.redirect');

Route::get('/login/{driver}/callback', [Socialize::class, 'callback'])->name('auth.callback');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
