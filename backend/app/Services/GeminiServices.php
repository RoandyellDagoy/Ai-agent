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


        // here we put the error handling 
         if ($response->failed()) {
            $error = $response->json()['error']['message'] ?? 'Something went wrong';
            return "❌ Gemini API Error: {$error}";
        }

        return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';
    }

     public function chat(array $messages): string
    {
        $apiKey = env('GOOGLE_API_KEY');

        // Convert messages into Gemini format
        $contents = [];
        foreach ($messages as $msg) {
            $contents[] = [
                'role' => $msg['role'],   // "user" or "model"
                'parts' => [['text' => $msg['text']]],
            ];
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
            'contents' => $contents,
        ]);

        if ($response->failed()) {
            $error = $response->json()['error']['message'] ?? 'Something went wrong';
            return "❌ Gemini API Error: {$error}";
        }

        return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '⚠️ No response';
    }
}
