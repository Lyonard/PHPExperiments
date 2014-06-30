<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/06/14
 * Time: 14.14
 */

namespace core;

use core\log\AbstractLogger;
use core\log\FileLogger;

require "Config.class.php";

class BootStrapper {
    public function __construct(){
        Config::init();
        $this->displayErrors();
        $this->initAutoloader();
        $this->initErrorHandler();
        $this->initExceptionHandler();
        $this->enableLoggers();
    }

    private function initAutoloader(){
        require Config::$autoloader.Config::$classExtension;
        $autoloaderClass = Config::$autoloaderCompleteClassName;
        new $autoloaderClass();
    }

    private function initErrorHandler(){
        $errorHandlerClass = Config::$errorHandlerCompleteClassName;
        new $errorHandlerClass();
    }

    private function initExceptionHandler(){
        $exceptionHandlerClass = Config::$exceptionHandlerCompleteClassName;
        new $exceptionHandlerClass();
    }

    private function displayErrors(){
        //ini_set("display_errors", Config::$displayErrors);
    }

    private function enableLoggers(){
        $ns = "\\core\\log\\";

        foreach (Config::$activeLogs as $log => $active){

            $className = $ns.$log."Logger";

            if($active) {
                Config::$loggers[$log] = new $className();
            }
        }
    }
}