<?php namespace Manulith\SketchfabPhp\Facades;

use Illuminate\Support\Facades\Facade;

class SketchfabPhp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sketchfab-php';
    }

}
