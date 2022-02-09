<?php

namespace hdvinnie\LaravelJoyPixels;

use Illuminate\Support\Facades\Facade;

class LaravelJoyPixelsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LaravelJoyPixels::class;
    }
}
