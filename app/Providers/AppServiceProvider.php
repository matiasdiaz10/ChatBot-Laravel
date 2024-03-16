<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Web\WebDriver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DriverManager::loadDriver(WebDriver::class);
        BotManFactory::create(config('botman.web'));
    }
}
