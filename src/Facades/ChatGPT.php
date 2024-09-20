<?php

namespace Iutrace\ChatGPT\Facades;

use Illuminate\Support\Facades\Facade;

class ChatGPT extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'chatgpt';
    }
}