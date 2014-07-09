<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 03/07/14
 * Time: 22.03
 */

namespace core\logic\controllers;

use core\Registry;

class PageController extends FrontController{

    public function __construct($request){
        parent::__construct($request);
    }

    public function doAction(){
        $registry = Registry::getInstance();
        $env = $registry['ENV'];
        $env['ajax'] = false;
        $registry['ENV'] = $env;

        $firstField = $this->getRequestHead($this->getRequest());

        if( $this->routeExists( $firstField ) ){
            $newRequest = $this->getRequestTail($this->getRequest());

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
} 