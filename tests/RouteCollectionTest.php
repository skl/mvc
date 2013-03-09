<?php namespace Orno\Tests;

use PHPUnit_Framework_Testcase;
use Orno\Mvc\Route\RouteCollection;
use Orno\Mvc\Route\Route;

class RouteCollectionTest extends PHPUnit_Framework_Testcase
{
    public function testAddRouteWithControllerAndAction()
    {
        $route = new RouteCollection;

        $route->add('/test/route', 'TestController@testAction');
        $this->assertTrue($route->getContainer()->registered('TestController'));
    }

    public function testAddRouteWithClosure() {
        $route = new RouteCollection;

        $route->add('/test/route', function () { return true; });
        $this->assertTrue($route->getContainer()->registered('/test/route'));
    }

    public function testProxyMethodsRegisterCorrectly()
    {
        $route = new RouteCollection;

        $route->get('/get/route', 'Controller@getAction');
        $route->post('/post/route', 'Controller@postAction');
        $route->put('/put/route', 'Controller@putAction');
        $route->patch('/patch/route', 'Controller@patchAction');
        $route->delete('/delete/route', 'Controller@deleteAction');
        $route->options('/options/route', 'Controller@optionsAction');

        $this->assertSame(count($route->getRoutes()), 6);

        foreach($route->getRoutes() as $method) {
            foreach ($method as $route) {
                $this->assertTrue($route instanceof Route);
            }
        }
    }

    public function testRestfulRouteCreatesAllRoutes()
    {
        $route = new RouteCollection;

        $route->restful('/restful', 'RestfulController');

        foreach ($route->getRoutes() as $method) {
            foreach ($method as $route) {
                $this->assertTrue($route instanceof Route);
            }
        }
    }
}