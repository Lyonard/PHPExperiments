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
            case E_USER_ERROR       :   self:: handleFatalError($errno, $errstr, $errfile, $errline);

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
//
//public static function fatalErrorHandler() {
//
//    $errorType = array (
//        E_CORE_ERROR        => 'E_CORE_ERROR',
//        E_COMPILE_ERROR     => 'E_COMPILE_ERROR',
//        E_ERROR             => 'E_ERROR',
//        E_USER_ERROR        => 'E_USER_ERROR',
//        E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
//        //E_DEPRECATED        => 'DEPRECATION_NOTICE', //From PHP 5.3
//    );
//
//    # Getting last error
//    $error = error_get_last();
//
//    # Checking if last error is a fatal error
//    switch ( $error['type'] ){
//        case E_CORE_ERROR:
//        case E_COMPILE_ERROR:
//        case E_ERROR:
//        case E_USER_ERROR:
//        case E_RECOVERABLE_ERROR:
//
//            ini_set( 'display_errors', 'Off' );
//
//            if( !ob_get_level() ){ ob_start(); }
//            else { ob_end_clean(); ob_start(); }
//
//            debug_print_backtrace();
//            $output = ob_get_contents();
//            ob_end_clean();
//
//            # Here we handle the error, displaying HTML, logging, ...
//            $output .= "<pre>\n";
//            $output .= "[ {$errorType[$error['type']]} ]\n\t";
//            $output .= "{$error['message']}\n\t";
//            $output .=  "Not Recoverable Error on line {$error['line']} in file " . $error['file'];
//            $output .=  " - PHP " . PHP_VERSION . " (" . PHP_OS . ")\n";
//            $output .=  " - REQUEST URI: " . print_r( @$_SERVER['REQUEST_URI'], true ) . "\n";
//            $output .=  " - REQUEST Message: " . print_r( $_REQUEST, true ) . "\n";
//            $output .=  "\n\t";
//            $output .=  "Aborting...\n";
//            $output .= "</pre>";
//
//            Log::$fileName = 'fatal_errors.txt';
//            Log::doLog( $output );
//            Utils::sendErrMailReport( $output );
//
//            header( "HTTP/1.1 200 OK" );
//
//            if( ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) || $_SERVER['REQUEST_METHOD'] == 'POST' ) {
//
//                //json_response
//                if( INIT::$DEBUG ){
//                    echo json_encode( array("errors" => array( array( "code" => -1000, "message" => $output ) ), "data" => array() ) );
//                } else {
//                    echo json_encode( array("errors" => array( array( "code" => -1000, "message" => "Oops we got an Error. Contact <a href='mailto:support@matecat.com'>support@matecat.com</a>" ) ), "data" => array() ) ) ;
//                }
//
//            } elseif( INIT::$DEBUG ){
//                echo $output;
//            }
//
//            break;
//    }
//
//}
