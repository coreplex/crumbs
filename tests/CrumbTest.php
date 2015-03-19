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

    public function testCrumbAccuratelyReportsWhetherItHasUrlOrNot()
    {
        $crumb = $this->makeCrumb();

        $this->assertFalse($crumb->hasUrl());
        $crumb->setUrl('//www.google.com');
        $this->assertTrue($crumb->hasUrl());
        $crumb->setUrl('');
        $this->assertFalse($crumb->hasUrl());
    }

    public function testCrumbAccuratelyReportsWhetherItHasLabelOrNot()
    {
        $crumb = $this->makeCrumb();

        $this->assertFalse($crumb->hasLabel());
        $crumb->setLabel('Google');
        $this->assertTrue($crumb->hasLabel());
        $crumb->setLabel('');
        $this->assertFalse($crumb->hasLabel());
    }

    public function testFluentGettersRetrieveSameResults()
    {
        $crumb = $this->makeCrumb()->setLabel('Google')->setUrl('//www.google.com');
        $this->assertEquals($crumb->getLabel(), $crumb->label());
        $this->assertEquals($crumb->getUrl(), $crumb->url());
    }

    public function makeCrumb()
    {
        return new Crumb;
    }

}