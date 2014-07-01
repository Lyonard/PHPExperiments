<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 01/07/14
 * Time: 2.05
 */

namespace core\logic;


use core\logic\exceptions\RouteNotFoundException;

class Router {
    /**
     * @var string The http request
     */
    public $request;
    public static $instance;

    public static $routes;

    private function __construct($request){
        $this->request = $request;
        //TODO: design routes and describe them.
    }

    public function getInstance($request){
        if ( self::$instance == null ) self::$instance = new Router($request);

        return self::$instance;
    }

    public function routeExists($route){
        return array_key_exists($route, self::$routes);
    }

    /**
     * @param $route String The route requested
     * @return mixed TO BE DECIDED
     * @throws exceptions\RouteNotFoundException Thrown if route is not found
     */
    public function getRouteData($route){
        if(!$this->routeExists($route)) throw new RouteNotFoundException("Route not found.");

        return self::$routes[$route];
    }
} 