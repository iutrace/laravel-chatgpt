<?php

namespace Iutrace\ChatGPT\Services;

use GuzzleHttp\Client;

class ChatGPTService
{
    public $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('chatgpt.base_url'),
            'headers' => [
                'Authorization' => 'Bearer ' . config('chatgpt.api_key'),
                'Content-Type'  => 'application/json',
            ],
        ]);

    }
    
    public function sendPrompt(string $prompt)
    {
        $response = $this->client->post('/v1/chat/completions', [
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => 100,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        
        return $data;
    }
}