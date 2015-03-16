<?php namespace Coreplex\Crumbs\Tests;

use Mockery as m;
use Coreplex\Crumbs\Container;
use PHPUnit_Framework_TestCase;
use Coreplex\Crumbs\Components\Crumb as Crumb;

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

    public function testContainerInstantiatesWithDependenciesAndMakesCrumbs()
    {
        $container = new Container(new Crumb);

        $this->assertInstanceOf('Coreplex\Crumbs\Contracts\Crumb', $this->invokeMethod($container, 'newCrumb'));
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