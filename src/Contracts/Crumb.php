<?php namespace Coreplex\Crumbs\Contracts;

interface Crumb {

    /**
     * Retrieve the breadcrumb label
     * 
     * @return string
     */
    public function getLabel();

    /**
     * Retrieve the breadcrumb label
     * 
     * @return string
     */
    public function label();

    /**
     * Whether or not this breadcrumb has a label
     * 
     * @return boolean
     */
    public function hasLabel();

    /**
     * Retrieve the breadcrumb URL
     * 
     * @return string
     */
    public function getUrl();

    /**
     * Retrieve the breadcrumb URL
     * 
     * @return string
     */
    public function url();

    /**
     * Whether or not this breadcrumb has a URL
     * 
     * @return boolean
     */
    public function hasUrl();

    /**
     * Set the label of the breadcrumb
     * 
     * @param  string $url
     * @return void
     */
    public function setLabel($label);

    /**
     * Set the URL of the breadcrumb
     * 
     * @param  string $url
     * @return void
     */
    public function setUrl($url);

    /**
     * Retrieve whether or not the breadcrumb is the current one
     * 
     * @return boolean
     */
    public function isCurrent();

    /**
     * Sets the breadcrumb to be the current location
     *
     * @return  void
     */
    public function setCurrent();

    /**
     * Sets the breadcrumb to not be the current location
     * 
     * @return  void
     */
    public function setNotCurrent();

}