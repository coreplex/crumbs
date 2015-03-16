<?php namespace Coreplex\Crumbs;

use Closure;

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
    public function construct()
    {
        $this->crumbs = new Illuminate\Support\Collection;
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