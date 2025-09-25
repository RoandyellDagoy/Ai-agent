<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiServices;


class GeminiController extends Controller
{
    protected $gemini;

    public function __construct(GeminiServices $gemini)
    {
        $this->gemini = $gemini;
    }

    // Single-shot text generation
    public function generate(Request $request)
    {
        $prompt = $request->input('prompt', 'Hello Gemini!');
        $response = $this->gemini->generateText($prompt);

        return response()->json(['response' => $response]);
    }

    // Chat conversation
    public function chat(Request $request)
    {
        $messages = $request->input('messages', []);
        $response = $this->gemini->chat($messages);

        return response()->json(['response' => $response]);
    }
}
