<?php

namespace Cswiley\Blogging;

use Illuminate\Support\ServiceProvider;

class BloggingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the applicatioan services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->loadMigrations();
        $this->loadRoutes();
        $this->loadConfig();
        $this->loadViews();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->loadHelpers();
        //
//        $this->app->singleton(StyleGuide::class, function () {
//            return new StyleGuide();
//        });

        $this->registerController();
        $this->registerPublish();

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
            dirname(__DIR__) . '/publishable/config/blog.php', 'blog'
        );
    }

    private function loadRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    private function registerController()
    {
//        $this->app->make('Cswiley\Blogging\StyleGuideController');
    }

    private function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'blog');
    }

    private function registerPublish()
    {
        $publishablePath = dirname(__DIR__) . '/../publishable';
        $resourcePath = dirname(__DIR__) . "/../resources";

        $publishable = [
           'assets' => [
               "{$publishablePath}/assets" => public_path(config('blog.assets_path'))
           ],
           'config' => [
               "{$publishablePath}/config/blog.php" => config_path('blog.php'),
           ],
           'views' => [
              "{$resourcePath}/views"  => resource_path('views/vendor/blogging'),
           ],
           'js' => [
               "{$resourcePath}/js"  => resource_path('views/vendor/blogging'),
           ],
           'sass' => [
               "{$resourcePath}/views"  => resource_path('views/vendor/blogging'),
           ],
        ];

        foreach ($publishable as $label => $val) {
            $this->publishes($val, $label);
        }
    }


}
