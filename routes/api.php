<?php

use App\Http\Controllers\ChatController;
use App\Http\Middleware\CheckDailyCreditLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriptionController;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/subscription', [SubscriptionController::class, 'subscription']);
Route::post('/chat', [ChatController::class, 'store'])->middleware([CheckDailyCreditLimit::class]);

