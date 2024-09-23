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
    
    public function sendPrompt(string $prompt, $image = null)
    {

        $payload = [
            'model' => 'gpt-4o-mini',
            'messages' => [
                [   
                    'role' => 'user', 
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => $prompt,
                        ],
                        !$image ?: [
                            'type' => 'image_url',
                            'image_url' => [
                                'url' => $image,
                            ]
                        ]
                    ],
                ],
            ],
        ];

        $response = $this->client->post('/v1/chat/completions', [
            'json' => $payload,
        ]);

        return json_decode($response->getBody()->getContents(), true);

    }
}