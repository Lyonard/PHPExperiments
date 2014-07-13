<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 09/07/14
 * Time: 12.28
 */

namespace core\logic\response;


use core\Registry;

class ResponseFactory {

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(self::$instance == null) self::$instance = new ResponseFactory();
        return self::$instance;
    }

    /**
     * @param $responseType string
     * @return IResponse
     */
    public function getResponseObject($responseType){
        $responseClassName = Registry::get('config')->get('responseNameSpace').$responseType."Response";

        if( in_array( $responseType, Registry::get('config')->get('allowed_responses')->toArray() ) ){
            return new $responseClassName();
        }
        else {
            throw new \Exception("Response type invalid");
        }
    }
} 