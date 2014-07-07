<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/06/14
 * Time: 14.14
 */

namespace core;

require "Config.php";

class BootStrapper {
    public function __construct(){

        Config::init();

        $this->displayErrors();

        //this method has to be called before instantiating the autoloader because it's not namespaced
        $this->enableLoggers();

        //this method has to be called before instantiating the autoloader because it's not namespaced
        $this->initTwig();

        $this->initAutoloader();

        $this->initErrorHandler();

        $this->initExceptionHandler();

        $this->startController();
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

    private function initTwig(){
        require_once Config::$twigAutoloaderCompleteClassName.".php";
        \Twig_Autoloader::register();
    }

    private function enableLoggers(){
        include implode(DIRECTORY_SEPARATOR, array(
            dirname(__FILE__),
            "logic",
            "log",
            "Logger.php"
        ));

        \Logger::configure(implode(
                DIRECTORY_SEPARATOR,
                array(
                    dirname(__FILE__),
                    Config::$loggerConfigFilePath
                )
            )
        );
    }

    private function startController(){
        $request    = trim($_SERVER['REQUEST_URI'], "/");
        $request    = explode("/", $request);

        $base_path  = explode("/", Config::$userFolders['root']);
        $request = implode("/", array_slice($request, count($base_path) ) );

        if(empty($request)) $request = "index";

        $controller = new \core\logic\controllers\FrontController($request);

        $controller->doAction();
    }
}