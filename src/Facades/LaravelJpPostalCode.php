<?php

namespace Sukohi\LaravelJpPostalCode\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelJpPostalCode extends Facade {

    /**
    * Get the registered name of the component.
    *
    * @return string
    */
    protected static function getFacadeAccessor() { return 'laravel-jp-postal-code'; }

}