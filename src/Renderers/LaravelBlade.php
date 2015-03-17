<?php namespace Coreplex\Crumbs\Renderers;

use Coreplex\Crumbs\Contracts\Renderer as Contract;
use Coreplex\Crumbs\Contracts\Container;
use Illuminate\Contracts\View\Factory as ViewFactory;

class LaravelBlade implements Contract {

    /**
     * The View Factory implementation
     * 
     * @var Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * Make a new LaravelBlade instance
     * 
     * @param Illuminate\Contracts\View\Factory $view
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

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