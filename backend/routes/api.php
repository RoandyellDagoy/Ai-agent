<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\GeminiServices;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\AuthController;


Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/me',[AuthController::class, 'profile']);
    Route::post('/logout',[AuthController::class, 'logout']);   
});

Route::post('/gemini/generate', [GeminiController::class, 'generate']);
Route::post('/gemini/chat', [GeminiController::class, 'chat']);




