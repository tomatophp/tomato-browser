<?php

namespace TomatoPHP\TomatoBrowser;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoBrowser\Menus\BrowserMenu;
use TomatoPHP\TomatoPHP\Services\Menu\TomatoMenuRegister;


class TomatoBrowserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\TomatoBrowser\Console\TomatoBrowserInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/tomato-browser.php', 'tomato-browser');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/tomato-browser.php' => config_path('tomato-browser.php'),
        ], 'tomato-browser-config');

        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-browser');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-browser'),
        ], 'tomato-browser-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-browser');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => app_path('lang/vendor/tomato-browser'),
        ], 'tomato-browser-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        TomatoMenuRegister::registerMenu(BrowserMenu::class);

    }

    public function boot(): void
    {
        //you boot methods here
    }
}
