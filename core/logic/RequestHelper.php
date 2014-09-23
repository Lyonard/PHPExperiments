<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 21/09/14
 * Time: 23.33
 */

namespace core\logic;


use core\Registry;

class RequestHelper {

    /**
     * Configures ENV variable for ajax request and response type
     */
    public static function configureFromRequestHeader() {
        $env = Registry::get( 'ENV' );

        if(self::checkAjax()){
            $env->set( 'ajax', true );

            $respType = self::getResponseType();
            $env->set('responseType', $respType);
        }
        else{
            $env->set( 'ajax', false );
            $env->set( 'responseType', 'html' );
        }
        Registry::set('ENV', $env);
    }

    /**
     * Checks if the current request is an Ajax request
     * @return bool True if the current request is an Ajax request, false otherwise
     */
    private static function checkAjax() {
        return ( isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) === 'xmlhttprequest' );
    }

    /**
     * Reads the HTTP header's "Accept" parameter and gets the first available mime type.
     * @return string An internal string representing the response type.
     */
    private static function getResponseType() {
        preg_match_all( "#([^/]*/[^,;]*|\*/\*)[,;]?(q=[0-9\.]{3})?,?#", $_SERVER[ 'HTTP_ACCEPT' ], $responseTypes );

        $responseTypes = $responseTypes[ 1 ];

        $respType = null;
        foreach ( $responseTypes as $rType ) {
            switch ( $rType ) {
                case 'text/html' :
                    $respType = "html";
                    break;
                case 'application/json' :
                case 'text/json' :
                    $respType = "json";
                    break;
                case 'application/xml'  :
                    $respType = 'xml';
                    break;
                case 'text/plain'  :
                    $respType = 'text';
                    break;
                default:
                    break;
            }

            if($respType != null) break;
        }

        if($respType == null) $respType = 'json';
        return $respType;
    }


}