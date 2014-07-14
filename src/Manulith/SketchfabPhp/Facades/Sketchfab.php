<?php namespace Manulith\Sketchfab\Facades;

use Illuminate\Support\Facades\Facade;

class Sketchfab extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sketchfab';
    }

}
