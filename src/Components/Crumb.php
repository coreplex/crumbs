<?php namespace Coreplex\Crumbs\Components;

use Coreplex\Crumbs\Contracts\Crumb as Contract;
use Exception;

class Crumb implements Contract {

    /**
     * The label of this breadcrumb
     * 
     * @var string
     */
    protected $label;

    /**
     * The URL of this breadcrumb
     * 
     * @var string
     */
    protected $url;

    /**
     * Whether or not this breadcrumb is the current location
     * 
     * @var boolean
     */
    protected $current = false;

    /**
     * Retrieve the breadcrumb label
     * 
     * @return string
     */
    public function getLabel()
    {
        throw new Exception("Method not implemented");
    }

    /**
     * Retrieve the breadcrumb URL
     * 
     * @return string
     */
    public function getUrl()
    {
        throw new Exception("Method not implemented");
    }

    /**
     * Set the label of the breadcrumb
     * 
     * @param  string $url
     * @return void
     */
    public function setLabel($label)
    {
        throw new Exception("Method not implemented");
    }

    /**
     * Set the URL of the breadcrumb
     * 
     * @param  string $url
     * @return void
     */
    public function setUrl($url)
    {
        throw new Exception("Method not implemented");
    }

    /**
     * Retrieve whether or not the breadcrumb is the current one
     * 
     * @return boolean
     */
    public function isCurrent()
    {
        throw new Exception("Method not implemented");
    }

    /**
     * Sets the breadcrumb to be the current location
     *
     * @return  void
     */
    public function setCurrent()
    {
        throw new Exception("Method not implemented");
    }

    /**
     * Sets the breadcrumb to not be the current location
     * 
     * @return  void
     */
    public function setNotCurrent()
    {
        throw new Exception("Method not implemented");
    }

}