<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 01/07/14
 * Time: 1.52
 */

namespace core\logic\controllers;

use core\Config;
use core\mvc\Controller;

class FrontController extends Controller{

    public function __construct($request){
        if ($request == null) $request = "defaultPage";

        $this->setRequest($request);
    }

    public function doAction(){

        $nextController = null;

        if($this->checkAjax()){
            $nextController = new AjaxController( $this->getRequest() );
        }
        else{
            $nextController = new PageController( $this->getRequest() );
        }

        $nextController->doAction();
    }

    private function checkAjax(){
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    }

    /**
     * @param $route string The prefix of the next controller to be called <br/>
     *                      <u>Example</u>: if we want to call SearchController, $request = "Search"
     * @return bool True if class exists, false otherwise
     */
    protected function routeExists($route){
        try{
            return class_exists(Config::$userFolders['controller'].DIRECTORY_SEPARATOR.$route."Controller");
        }
        catch(\ErrorException $e){
            return false;
        }
    }

    /**
     * Returns the name of the next Controller to be called, depending on the given $route
     * @param $route string The route path
     * @return string
     */
    protected function getNextControllerName($route){
        $routeClass = Config::$userFolders['controller'].DIRECTORY_SEPARATOR.$route."Controller";
        return $routeClass;
    }

    /**
     * Gets a folder path and pops first the field starting from the left.<br/>
     * <u>Notice</u>: $route is passed by reference and is modified as a side effect.
     * @param $route string The folder path
     * @return string The first field of the path
     */
    protected function popFirstField(&$route){
        $routeArr = explode("/",$route);
        $firstField = array_shift($routeArr);
        $route = implode("/",$routeArr);
        return $firstField;
    }

    /**
     * Gets a folder path and pops first the field starting from the left.<br/>
     * @param $route string The folder path
     * @return string The first field of the path
     */
    protected function getFirstField($route){
        $routeArr = explode("/",$route);
        $firstField = array_shift($routeArr);
        $route = implode("/",$routeArr);
        return $firstField;
    }

} 