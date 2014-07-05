<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 03/07/14
 * Time: 22.03
 */

namespace core\logic\controllers;


class PageController extends FrontController{

    public function __construct($request){
        parent::__construct($request);
    }

    public function doAction(){
        $firstField = $this->getFirstField($this->getRequest());
        if( $this->routeExists( $firstField ) ){
            echo __CLASS__." ".$firstField."Controller exists.";
        }
        else
            echo __CLASS__." ".$firstField."Controller does not exist.";
    }
} 