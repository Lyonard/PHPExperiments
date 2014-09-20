<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 01/07/14
 * Time: 1.52
 */

namespace core\logic\controllers;

use core\Registry;
use core\mvc\Controller;
use views\ErrorPageView;

class FrontController extends Controller{

    public function __construct($request){
        $this->setRequest($request);
    }

    public function doAction(){
        $nextController = null;

        $firstField = $this->getRequestHead($this->getRequest());
        $newRequest = $this->getRequestTail($this->getRequest());

        try{
            $env = Registry::get('ENV');
            if($this->checkAjax()){
                $env ->set( 'ajax', true );

                $respType = $this->getRequestHead($newRequest);
                $env ->set( 'responseType', $respType);
            }
            else{
                $env->set( 'ajax', false );
                $env->set( 'responseType', 'html' );
            }
            Registry::set('ENV', $env);

            if( $this->routeExists( $firstField ) ){

                $nextControllerName = $this->getNextControllerName($firstField);

                /**
                 * @var $nextController \core\mvc\Controller
                 */
                $nextController = new $nextControllerName($newRequest);
                $nextController->doAction();
            }
            else{
                $this->goErrorPage(404);
            }

        }
        catch(\Exception $e){
            $this->goErrorPage(500);
        }

    }

    /**
     * Checks if the current request is an Ajax request
     * @return bool True if the current request is an Ajax request, false otherwise
     */
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
            return class_exists(Registry::get('config')->get('USER_FOLDERS')->get('controllers').DIRECTORY_SEPARATOR.$route."Controller");
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
        $routeClass = Registry::get('config')->get('USER_FOLDERS')->get('controllers').DIRECTORY_SEPARATOR.$route."Controller";
        return $routeClass;
    }

    /**
     * Gets a folder path and returns the first field starting from the left.<br/>
     * @param $request string The folder path
     * @return string The first field of the path
     */
    protected function getRequestHead($request){
        $routeArr = explode("/",$request);
        $firstField = array_shift($routeArr);

        return $firstField;
    }

    /**
     * Gets a folder path, trims the first field and returns the remaining path.<br/>
     * @param $request string The folder path
     * @return string The path trimmed by its first field
     */
    protected function getRequestTail($request){
        $routeArr = explode("/",$request);
        array_shift($routeArr);

        return implode("/", $routeArr);
    }

    protected function goErrorPage($errorCode){
        $errorView = new ErrorPageView();
        $errorView->setErrorCode($errorCode);
        $errorView->render();
        exit;
    }
} 