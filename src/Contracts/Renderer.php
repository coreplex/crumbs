<?php namespace Coreplex\Crumbs\Contracts;

use Coreplex\Crumbs\Contracts\Container;

interface Renderer {

    /**
     * Render the breadcrumbs from the container
     * 
     * @return string
     */
    public function render(Container $container);

}