<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/06/14
 * Time: 14.14
 */

namespace core;

require "Registry.php";

class BootStrapper {

    private $registry;

    public function __construct(){

        $this->registry = Registry::getInstance();

        $this->init();
    }

    private function init(){
        $this->registry->init();

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

        require $this->registry['config']['AUTOLOADER']['className'].".php";
        $autoloaderClass = $this->registry['config']['AUTOLOADER']['nameSpace'];
        new $autoloaderClass();
    }

    private function initErrorHandler(){
        $errorHandlerClass = $this->registry['config']['errorHandlerNameSpace'];
        new $errorHandlerClass();
    }

    private function initExceptionHandler(){
        $exceptionHandlerClass = $this->registry['config']['exceptionHandlerNameSpace'];
        new $exceptionHandlerClass();
    }

    private function displayErrors(){
        //ini_set("display_errors", Config::$displayErrors);
    }

    private function initTwig(){
        require_once $this->registry['config']['AUTOLOADER']['twigNameSpace'].".php";
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
                    $this->registry['config']['LOG']['config']
                )
            )
        );
    }

    private function startController(){
        $request    = trim($_SERVER['REQUEST_URI'], "/");
        $request    = explode("/", $request);

        $base_path  = explode("/", $this->registry['config']['USER_FOLDERS']['root']);
        $request = implode("/", array_slice($request, count($base_path) ) );

        if(empty($request)) $request = "index";

        $controller = new \core\logic\controllers\FrontController($request);

        $controller->doAction();
    }
}