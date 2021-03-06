<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 29/06/14
 * Time: 4.00
 */

namespace core\logic\errors;


class ExceptionHandler {

    public function __construct(){
        //echo "<pre>";
        set_exception_handler( array($this, 'handleException') );
    }

    public static function handleException($e){
        $message = "<pre>\nUncaught exception: " . $e->getMessage(). "\n".
                    $e->getTraceAsString();

        echo $message;
        echo "\n\nCODE : ".$e->getCode()."\n</pre>";

        if($e->getCode() == E_ERROR ||
            $e->getCode() == E_USER_ERROR ) exit (1);
    }
} 