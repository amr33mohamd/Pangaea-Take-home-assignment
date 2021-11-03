<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/publish/{topic}', [\App\Http\Controllers\TopicController::class, 'store'])->name('topics.store');
Route::post('/subscribe/{topic}', [\App\Http\Controllers\SubscriberController::class, 'store'])->name('subscribers.store');
