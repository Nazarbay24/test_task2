<?php

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

// Ранжирование рользователей
Route::post('add-user', [\App\Http\Controllers\Controller::class, 'addUser']);
Route::get('get-top', [\App\Http\Controllers\Controller::class, 'getTop']);

// Пуш уведомления
Route::post('send-push', [\App\Http\Controllers\Controller::class, 'sendPush']);


