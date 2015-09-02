<?php

namespace Manulith\SketchfabPhp;

use Illuminate\Foundation\AliasLoader;
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
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'sketchfab');

        $this->app->singleton('sketchfab-php', function($app) {
            return new SketchfabPhp;
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../../config/config.php' => config_path('sketchfab.php')]);

        AliasLoader::getInstance()->alias(
            'Sketchfab',
            'Manulith\SketchfabPhp\Facades\SketchfabPhp'
        );
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