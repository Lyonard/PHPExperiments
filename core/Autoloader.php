<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/06/14
 * Time: 3.04
 */

namespace core;

class Autoloader {
    private static $defaultClassExtension;

    public function __construct(){
        self::$defaultClassExtension = ".php";
        set_include_path(dirname(__FILE__));
        spl_autoload_register(array($this, 'importClass'));
    }

    private function importClass($className){
        $classExtension     = Config::$classExtension;
        $namespaceSeparator = Config::$namespaceSeparator;

        $className          = ltrim($className, $namespaceSeparator);
        $fileName           = '';

        $fileName .= str_replace($namespaceSeparator, DIRECTORY_SEPARATOR, $className);

        include $fileName.$classExtension;
    }
}
