<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 01/07/14
 * Time: 1.52
 */

namespace core;

use core\mvc\Controller;

class FrontController extends Controller{
    private static $instance;
    private $request;

    private function __construct($request){
        $this->request = $request;
    }

    public static function getInstance($request){
        if ($request == null) throw new \ErrorException("Request Empty");

        if(self::$instance == null)
            self::$instance = new FrontController($request);

        return self::$instance;
    }

} 