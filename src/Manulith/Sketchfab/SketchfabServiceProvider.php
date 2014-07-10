<?php namespace Manulith\Sketchfab;

use Illuminate\Support\ServiceProvider;

class SketchfabServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('manulith/sketchfab');

        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Sketchfab', 'Manulith\Sketchfab\Facades\Sketchfab');
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['sketchfab'] = $this->app->share(function ($app) {
            return new Sketchfab;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
