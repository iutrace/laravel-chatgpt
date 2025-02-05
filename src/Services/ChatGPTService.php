<?php

namespace Iutrace\ChatGPT\Services;

use Exception;
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

    public function sendPrompt(string $prompt, $imageContent = null, $mimeType = null, string $systemRole = '', float $temperature = 0.7)
    {
        if ($imageContent && !$mimeType) {
            throw new Exception("Mimetype missing");
        }

        $payload = [
            'model' => 'gpt-4o',
            'max_tokens' => config('chatgpt.max_tokens'),
            'temperature' => $temperature,
            'messages' => [
                
                [
                    'role' => 'user',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => $prompt,
                        ],
                    ],
                ],
            ],
        ];

        if (!empty($systemRole)) {
            $payload['messages'][0]['content'][] = [
                'role' => 'system',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => $systemRole,
                    ],
                ],
            ];
        }

        if ($imageContent) {
            $payload['messages'][0]['content'][] = [
                'type' => 'image_url',
                'image_url' => [
                    'url' => 'data:' . $mimeType . ';base64,' . base64_encode($imageContent),
                ]
            ];
        }

        $response = $this->client->post('/v1/chat/completions', [
            'json' => $payload,
        ]);

        return json_decode($response->getBody()->getContents(), true)['choices'][0]['message']['content'];
    }
}
