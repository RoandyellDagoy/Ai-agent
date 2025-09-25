<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Services\GeminiServices;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/gemini-service-test', function (GeminiServices $gemini) {
    return $gemini->generateText("Write a short poem about Laravel.");
});

