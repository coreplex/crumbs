<?php namespace Coreplex\Crumbs;

use Closure;
use Coreplex\Crumbs\Components\Crumb;
use Coreplex\Crumbs\Contracts\Crumb as CrumbContract;
use Coreplex\Crumbs\Contracts\Container as Contract;

class Container implements Contract {

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
    public function construct(CrumbContract $crumb)
    {
        $this->crumbs = [];

        $this->crumb = $crumb;
    }

    /**
     * Add a new crumb
     * 
     * @param string $label
     * @param string $url
     * @param array $data
     */
    public function add($label, $url, $atEnd = true)
    {
        $crumb = $this->newCrumb();
        $crumb->setLabel($label);
        $crumb->setUrl($url);

        if ($atEnd) {
            array_push($this->crumbs, $crumb);
        } else {
            array_unshift($this->crumbs, $crumb);
        }
    }

    /**
     * Appends a new crumb to the container
     * 
     * @param  string $label
     * @param  string $url
     * @return void
     */
    public function append($label, $url)
    {
        $this->add($label, $url, true);
    }

    /**
     * Prepends a new crumb to the container
     * 
     * @param  string $label
     * @param  string $url
     * @return void
     */
    public function prepend($label, $url)
    {
        $this->add($label, $url, true);
    }

    /**
     * Add an anonymous function to prepare the breadcrumbs
     * 
     * @param  Closure $closure
     * @return $this
     */
    public function prepare(Closure $closure)
    {
        $this->addPreparation($closure);

        return $this;
    }

    /**
     * Return all crumbs
     * 
     * @return array
     */
    public function getCrumbs()
    {
        return $this->crumbs;
    }

    /**
     * Return how many crumbs are in the container
     * 
     * @return integer
     */
    public function count()
    {
        return count($this->crumbs);
    }

    /**
     * Render the breadcrumbs
     * 
     * @return string
     */
    public function render()
    {
        return "";
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

    protected function build()
    {
        foreach ($this->getPreparations() as $preparation) {
            $preparation($this);
        }
    }

    /**
     * Add a preparation closure to the crumbs instance
     * 
     * @param  Closure $closure
     * @return void
     */
    protected function addPreparation(Closure $closure)
    {
        $this->preparations[] = $closure;
    }

    /**
     * Retrieve all preparation closures from the crumbs instance
     * 
     * @return array
     */
    protected function getPreparations()
    {
        return $this->preparations;
    }

}