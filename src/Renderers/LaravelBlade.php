<?php namespace Coreplex\Crumbs\Renderers;

use Coreplex\Crumbs\Contracts\Renderer as Contract;
use Coreplex\Crumbs\Contracts\Container;

class LaravelBlade implements Contract {

    /**
     * Render the breadcrumbs from the container
     * 
     * @return string
     */
    public function render(Container $container)
    {
        return $this->view->make(config('crumbs.view'))->with('container', $container)->render();
    }

}