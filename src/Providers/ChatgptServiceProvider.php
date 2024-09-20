<?php

namespace Iutrace\ChatGPT\Providers;

use Illuminate\Support\ServiceProvider;
use Iutrace\ChatGPTS\Services\ChatGPTService;

class ChatGPTServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/chatgpt.php', 'chatgpt'
        );

        $this->app->singleton('chatgpt', function ($app) {
            return new ChatGPTService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/chatgpt.php' => config_path('chatgpt.php'),
        ], 'config');
    }
}