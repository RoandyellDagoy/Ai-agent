<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiServices
{
    public function generateText(string $prompt): string
    {
        $apiKey = env('GOOGLE_API_KEY');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
            'contents' => [
                ['parts' => [['text' => $prompt]]],
            ],
        ]);

        return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';
    }
}
