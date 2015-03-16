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
        return $this->label;
    }

    /**
     * Whether or not this breadcrumb has a label
     * 
     * @return boolean
     */
    public function hasLabel()
    {
        return ! empty($this->getLabel());
    }

    /**
     * Retrieve the breadcrumb URL
     * 
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Whether or not this breadcrumb has a URL
     * 
     * @return boolean
     */
    public function hasUrl()
    {
        return ! empty($this->getUrl());
    }

    /**
     * Set the label of the breadcrumb
     * 
     * @param  string $url
     * @return void
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Set the URL of the breadcrumb
     * 
     * @param  string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Retrieve whether or not the breadcrumb is the current one
     * 
     * @return boolean
     */
    public function isCurrent()
    {
        return $this->current;
    }

    /**
     * Sets the breadcrumb to be the current location
     *
     * @return  void
     */
    public function setCurrent()
    {
        $this->current = true;
    }

    /**
     * Sets the breadcrumb to not be the current location
     * 
     * @return  void
     */
    public function setNotCurrent()
    {
        $this->current = false;
    }

}