<?php namespace Coreplex\Crumbs\Facades;

use Illuminate\Support\Facades\Facade;

class Crumbs extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'Coreplex\Crumbs\Contracts\Container'; }

}