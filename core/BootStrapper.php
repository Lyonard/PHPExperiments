<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/06/14
 * Time: 14.14
 */

namespace core;

require "Registry.php";
require "ArrayClass.php";

class BootStrapper {

    public function __construct(){
        $this->init();
    }

    private function init(){
        Registry::init();

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
        require Registry::get('config')->get('AUTOLOADER')->get('className').".php";

        $autoloaderClass = Registry::get('config')->get('AUTOLOADER')->get('nameSpace');
        new $autoloaderClass();
    }

    private function initErrorHandler(){
        $errorHandlerClass = Registry::get('config')->get('errorHandlerNameSpace');
        new $errorHandlerClass();
    }

    private function initExceptionHandler(){
        $exceptionHandlerClass = Registry::get('config')->get('exceptionHandlerNameSpace');
        new $exceptionHandlerClass();
    }

    private function displayErrors(){
        //ini_set("display_errors", Config::$displayErrors);
    }

    private function initTwig(){
        require_once Registry::get('config')->get('AUTOLOADER')->get('twigNameSpace').".php";
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
                    Registry::get('config')->get('LOG')->get('config')
                )
            )
        );
    }

    private function startController(){
        $request    = trim($_SERVER['REQUEST_URI'], "/");
        $request    = explode("/", $request);

        $base_path  = explode("/", Registry::get('config')->get('USER_FOLDERS')->get('root'));
        $request = implode("/", array_slice($request, count($base_path) ) );

        if(empty($request)) $request = "index";

        $controller = new \core\logic\controllers\FrontController($request);

        $controller->doAction();
    }
}