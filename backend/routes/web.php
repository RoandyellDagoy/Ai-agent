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

Route::get('/gemini-chat', function (GeminiServices $gemini) {
    $messages = [
        ['role' => 'user', 'text' => 'Hello, who are you?'],
        ['role' => 'model', 'text' => 'I am Gemini, your AI assistant.'],
        ['role' => 'user', 'text' => 'Tell me a joke about Laravel'],
    ];

    return $gemini->chat($messages);
});
