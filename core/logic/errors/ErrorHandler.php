<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/06/14
 * Time: 15.20
 */

namespace core\logic\errors;


class ErrorHandler {

    public function __construct(){
        set_error_handler(array($this, 'handleError')  );
        register_shutdown_function(array($this, 'shutdown'));
    }

    public static function handleError($errno, $errstr, $errfile=null, $errline=null){
        $return = false;
        switch($errno){
            case E_ERROR            :
            case E_USER_ERROR       : self:: handleFatalError($errno, $errstr, $errfile, $errline);

            case E_WARNING          :
            case E_NOTICE           :
            case E_DEPRECATED       :
            case E_RECOVERABLE_ERROR:   self::handlePhpError($errno, $errstr, $errfile, $errline);
                                        break;
            case E_USER_WARNING     :
            case E_USER_DEPRECATED  :
            case E_USER_NOTICE      :   $return = self::handleUserError($errno, $errstr, $errfile, $errline);
                                        break;

            default:
        }

        return $return;
    }

    private static function handleFatalError($errno, $errstr, $errfile=null, $errline=null){
        self::shutdown($errno, $errstr, $errfile, $errline);
        exit();
    }

    private static function handleUserError($errno, $errstr, $errfile=null, $errline=null){
        $message = "[USER_ERROR - $errno] $errstr in $errfile at line $errline";
        throw new \ErrorException($message, 0, $errno, $errfile ,$errline);
        //return true;
    }

    private static function handlePhpError($errno, $errstr, $errfile=null, $errline=null){
        ///echo __METHOD__."   .   $errno";
        $message = "[USER_ERROR - $errno] $errstr in $errfile at line $errline";
        throw new \ErrorException($message,0 , $errno, $errfile ,$errline);
        //return true;
    }

    public static function shutdown($errno=null, $errstr=null, $errfile=null, $errline=null){
        $error = error_get_last();

        if($error && count($error) > 0 )
            throw new \ErrorException($error['message'], 1, $error['type'], $error['file'], $error['line'] );
        exit(1);
    }
}