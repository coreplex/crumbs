<?php namespace Coreplex\Crumbs\Contracts;

use Closure;

interface Container {

	/**
     * Add a new crumb
     * 
     * @param string $label
     * @param string $url
     * @param array $data
     */
    public function add($label, $url, $atEnd = true);

    /**
     * Appends a new crumb to the container
     * 
     * @param  string $label
     * @param  string $url
     * @return void
     */
    public function append($label, $url);

    /**
     * Prepends a new crumb to the container
     * 
     * @param  string $label
     * @param  string $url
     * @return void
     */
    public function prepend($label, $url);

    /**
     * Add an anonymous function to prepare the breadcrumbs
     * 
     * @param  Closure $closure
     * @return $this
     */
    public function prepare(Closure $closure);

    /**
     * Return all crumbs
     * 
     * @return array
     */
    public function getCrumbs();

    /**
     * Return how many crumbs are in the container
     * 
     * @return integer
     */
    public function count();

    /**
     * Render the breadcrumbs
     *
     * @param  $lastLinkIsCurrent boolean
     * @return string
     */
    public function render($lastLinkIsCurrent = true);

}