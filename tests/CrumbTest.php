<?php namespace Coreplex\Crumbs\Tests;

use Mockery as m;
use Coreplex\Crumbs\Components\Crumb;
use Coreplex\Crumbs\Contracts\Crumbs as Contract;
use PHPUnit_Framework_TestCase;

class CrumbsTest extends PHPUnit_Framework_TestCase {

    /**
     * Setup resources and dependencies.
     *
     * @return void
     */
    public function setUp()
    {

    }

    /**
     * Close mockery.
     *
     * @return void
     */
    public function tearDown()
    {
        m::close();
    }

    public function testCrumbAbidesContract()
    {
        $crumb = $this->makeCrumb();

        $this->assertInstanceOf('Coreplex\Crumbs\Contracts\Crumb', $crumb);
    }

    public function testCrumbSetsAndGetsLabel()
    {
        $label = 'Homepage';

        $crumb = $this->makeCrumb();

        $crumb->setLabel($label);

        $this->assertEquals($crumb->getLabel(), $label);
    }

    public function testCrumbSetsAndGetsUrl()
    {
        $url = '//www.google.com';
        $crumb = $this->makeCrumb();

        $crumb->setUrl($url);

        $this->assertEquals($crumb->getUrl(), $url);
    }

    public function testCrumbSetsCurrentAndNotCurrent()
    {
        $crumb = $this->makeCrumb();

        $crumb->setCurrent();
        $this->assertTrue($crumb->isCurrent());


        $crumb->setNotCurrent();
        $this->assertFalse($crumb->isCurrent());
    }

    public function makeCrumb()
    {
        return new Crumb;
    }

}