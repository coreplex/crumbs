<?php namespace Coreplex\Crumbs;

use Closure;
use Coreplex\Crumbs\Components\Crumb;
use Coreplex\Crumbs\Contracts\Crumb as CrumbContract;
use Coreplex\Crumbs\Contracts\Renderer as RendererContract;
use Coreplex\Crumbs\Contracts\Container as Contract;

class Container implements Contract {

    /**
     * The crumb implementation
     * 
     * @var Coreplex\Crumbs\Contracts\Crumb $crumb
     */
    protected $crumb;

    /**
     * The renderer implementation
     * 
     * @var Coreplex\Crumbs\Contracts\Renderer $renderer
     */
    protected $renderer;

    /**
     * The collection of breadcrumbs
     * 
     * @var array $crumbs
     */
    protected $crumbs;

    /**
     * Make a new crumbs instance
     * 
     * @return void
     */
    public function __construct(CrumbContract $crumb, RendererContract $renderer)
    {
        $this->crumbs = [];

        $this->crumb = $crumb;

        $this->renderer = $renderer;
    }

    /**
     * Add a new crumb
     * 
     * @param string $label
     * @param string $url
     * @param array $data
     */
    public function add($label = "", $url = "", $atEnd = true)
    {
        $crumb = $this->newCrumb();
        $crumb->setLabel($label);
        $crumb->setUrl($url);

        if ($atEnd) {
            array_push($this->crumbs, $crumb);
        } else {
            array_unshift($this->crumbs, $crumb);
        }

        return $this;
    }

    /**
     * Appends a new crumb to the container
     * 
     * @param  string $label
     * @param  string $url
     * @return void
     */
    public function append($label = "", $url = "")
    {
        $this->add($label, $url, true);

        return $this;
    }

    /**
     * Prepends a new crumb to the container
     * 
     * @param  string $label
     * @param  string $url
     * @return void
     */
    public function prepend($label = "", $url = "")
    {
        $this->add($label, $url, false);

        return $this;
    }

    /**
     * Add an anonymous function to prepare the breadcrumbs
     * 
     * @param  Closure $closure
     * @return $this
     */
    public function prepare(Closure $closure)
    {
        $closure($this);

        return $this;
    }

    /**
     * Return all crumbs
     * 
     * @return array
     */
    public function getCrumbs()
    {
        // Run any preparations before retrieving the crumbs
        $this->build();

        return $this->crumbs;
    }

    /**
     * Return all crumbs
     * 
     * @return array
     */
    public function crumbs()
    {
        return $this->getCrumbs();
    }

    /**
     * Return how many crumbs are in the container
     * 
     * @return integer
     */
    public function count()
    {
        $crumbs = $this->getCrumbs();

        return count($crumbs);
    }

    /**
     * Render the breadcrumbs
     * 
     * @return string
     */
    public function render($makeLastCrumbCurrent = true)
    {
        // Run any preparations before render
        $this->build();

        if ($this->count() > 0 && $makeLastCrumbCurrent) {
            $lastCrumb = array_pop($this->crumbs);

            $lastCrumb->setCurrent();

            array_push($this->crumbs, $lastCrumb);
        }

        return $this->renderer->render($this);
    }

    /**
     * Instantiates a new crumb
     * 
     * @return Coreplex\Crumbs\Contracts\Crumb;
     */
    protected function newCrumb()
    {
        return new $this->crumb;
    }

}