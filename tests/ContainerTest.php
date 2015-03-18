<?php namespace Coreplex\Crumbs\Tests;

use Mockery as m;
use Coreplex\Crumbs\Container;
use PHPUnit_Framework_TestCase;
use Coreplex\Crumbs\Components\Crumb as Crumb;
use Coreplex\Crumbs\Renderers\Basic as BasicRenderer;

class ContainerTest extends PHPUnit_Framework_TestCase {

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

    public function testContainerAbidesContract()
    {
        $container = $this->makeContainer();

        $this->assertInstanceOf('Coreplex\Crumbs\Contracts\Container', $container);
    }

    public function testContainerInstantiatesWithDependenciesAndMakesCrumbs()
    {
        $container = $this->makeContainer();

        $this->assertInstanceOf('Coreplex\Crumbs\Contracts\Crumb', $this->invokeMethod($container, 'newCrumb'));
    }

    public function testPrepareMethodAddsToContainerAndCountsCrumbs()
    {
        $container = $this->makeContainer();

        $container->prepare(function($crumbs)
        {
            $crumbs->append('Crumb 1', '//www.google.com');
            $crumbs->append('Crumb 2', '//www.yahoo.com');
        });

        $this->assertEquals($container->count(), 2);
    }

    public function testInvokesRendererAndReturnsValidString()
    {
        $container = $this->makeContainer();

        $container->append('Crumb 1', '//www.google.com');

        $this->assertNotEmpty($container->render());
    }

    public function testContainerWillPrependBreadcrumbAndGetInCorrectOrder()
    {
        $container = $this->makeContainer();

        $container->append('Crumb 1', '//www.google.com');
        $container->prepend('Crumb 0', '//www.yahoo.com');

        $crumbs = $container->getCrumbs();

        $firstCrumb = array_shift($crumbs);

        $this->assertEquals($firstCrumb->getLabel(), 'Crumb 0');
        $this->assertEquals($firstCrumb->getUrl(), '//www.yahoo.com');
    }

    public function testRenderFunctionCausesLastCrumbToCurrentByDefault()
    {
        $container = $this->makeContainer();

        $container->append('Crumb 1', '//www.google.com');
        $container->append('Crumb 0', '//www.yahoo.com');

        $container->render();

        foreach ($container->getCrumbs() as $crumb) {
            if ($crumb->getUrl() == "//www.yahoo.com") {
                $this->assertTrue($crumb->isCurrent());
            }
        }
    }

    public function testRenderFunctionCanBeModifiedToNotSetLastAsCurrent()
    {
        $container = $this->makeContainer();

        $container->append('Crumb 1', '//www.google.com');
        $container->append('Crumb 0', '//www.yahoo.com');

        $container->render(false);

        foreach ($container->getCrumbs() as $crumb) {
            if ($crumb->getUrl() == "//www.yahoo.com") {
                $this->assertFalse($crumb->isCurrent());
            }
        }
    }

    public function makeContainer()
    {
        return new Container(new Crumb, new BasicRenderer);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object
     * @param string $methodName
     * @param array  $parameters
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

}