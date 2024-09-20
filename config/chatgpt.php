<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ChatGPT API Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the ChatGPT API. All API requests will be made
    | to this URL. Ensure that it's correctly set in your .env file.
    |
    */

    'base_url' => env('CHATGPT_BASE_URL', 'https://api.openai.com/'),

    /*
    |--------------------------------------------------------------------------
    | ChatGPT Access Token
    |--------------------------------------------------------------------------
    |
    | This is the access token required to authenticate and interact with
    | the ChatGPT API. Store this value securely and load it from your
    | environment file.
    |
    */

    'api_key' => env('CHATGPT_API_KEY', ''),
];