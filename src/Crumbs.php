<?php namespace Coreplex\Crumbs;

use Closure;
use Coreplex\Crumbs\Components\Crumb;
use Coreplex\Crumbs\Contracts\Crumb as CrumbContract;

class Crumbs {

    /**
     * The collection of breadcrumbs
     * 
     * @var Illuminate\Support\Collection $crumbs
     */
    protected $crumbs;

    /**
     * Make a new crumbs instance
     * 
     * @return void
     */
    public function construct(CrumbContract $crumb)
    {
        $this->crumbs = new Illuminate\Support\Collection;

        $this->crumb = $crumb;
    }

    /**
     * Add a new crumb
     * 
     * @param string $label
     * @param string $url
     * @param array $data
     */
    public function add($label, $url, $position = 'end')
    {
        $crumb = $this->newCrumb();
        $crumb->setLabel($label);
        $crumb->setUrl($url);

        $this->crumbs->push($crumb);
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