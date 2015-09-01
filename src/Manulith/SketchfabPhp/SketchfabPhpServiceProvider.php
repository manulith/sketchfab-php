<?php

namespace Manulith\SketchfabPhp;

use Illuminate\Support\ServiceProvider;

class SketchfabPhpServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../../config/config.php' => config_path('sketchfab.php')]);

        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Sketchfab', 'Manulith\SketchfabPhp\Facades\SketchfabPhp');
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'sketchfab');

        $this->app['sketchfab-php'] = $this->app->share(function ($app) {
            return new SketchfabPhp;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SketchfabPhp::class];
    }
}
