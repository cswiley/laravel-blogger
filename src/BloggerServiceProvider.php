<?php

namespace Cswiley\Blogger;

use Illuminate\Support\ServiceProvider;

class BloggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the applicatioan services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->loadMigrations();
        $this->registerPublish();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
//        $this->app->singleton(StyleGuide::class, function () {
//            return new StyleGuide();
//        });

        $this->loadHelpers();
        $this->loadRoutes();
        $this->loadConfig();
        $this->loadViews();
//        $this->loadController();

    }

    private function loadHelpers()
    {
        foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../publishable/migrations');
    }


    public function loadConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/publishable/config/blogger.php', 'blogger'
        );
    }

    private function loadRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    private function loadController()
    {
//        $this->app->make('Cswiley\Blogger\Controllers\BlogController');
    }

    private function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'blogger');
    }

    private function registerPublish()
    {
        $publishablePath = dirname(__DIR__) . '/publishable';
        $resourcePath    = dirname(__DIR__) . "/resources";

        $publishable = [
//            'public'     => [
//                "{$publishablePath}/assets" => public_path(config('blogger.assets_path'))
//            ],
            'config'     => [
                "{$publishablePath}/config/blogger.php" => config_path('blogger.php'),
            ],
            'views'      => [
                "{$resourcePath}/views" => resource_path('views/vendor/blogger'),
            ],
            'assets' => [
                "{$resourcePath}/assets" => resource_path('assets/vendor/blogger'),
            ],
            'migrations' => [
                "{$publishablePath}/migrations/" => database_path('migrations')
            ],
            'fonts'      => [
                dirname(__DIR__) . '/fonts' => public_path('/fonts/')
            ]

        ];

        foreach ($publishable as $label => $val) {
            $this->publishes($val, $label);
        }
    }


}
