<?php namespace Coreplex\Crumbs;

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

}