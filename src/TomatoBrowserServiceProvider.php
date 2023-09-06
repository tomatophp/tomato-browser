<?php

namespace TomatoPHP\TomatoBrowser;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;


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

    }

    public function boot(): void
    {
        TomatoMenu::register([
            Menu::make()
                ->group(trans('tomato-browser::global.group'))
                ->label(trans('tomato-browser::global.title'))
                ->icon("bx bxs-folder")
                ->route("admin.browser.index"),
        ]);
    }
}
