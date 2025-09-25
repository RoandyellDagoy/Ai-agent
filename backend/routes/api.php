<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\GeminiServices;
use App\Http\Controllers\GeminiController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/gemini/generate', [GeminiController::class, 'generate']);
Route::post('/gemini/chat', [GeminiController::class, 'chat']);

