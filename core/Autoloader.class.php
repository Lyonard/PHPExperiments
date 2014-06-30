<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/06/14
 * Time: 3.04
 */

namespace core;

class Autoloader {
    public function __construct(){
        set_include_path(dirname(__FILE__));
        spl_autoload_register(array($this, 'importClass'));
    }

    private function importClass($className){
        $classExtension     = Config::$classExtension;
        $namespaceSeparator = Config::$namespaceSeparator;

        $className          = ltrim($className, $namespaceSeparator);
        $fileName           = '';
        $namespace          = '';
        if ($lastNamespacePos = strrpos($className, $namespaceSeparator)) {
            $namespace = substr($className, 0, $lastNamespacePos);

            $className = substr($className, $lastNamespacePos + 1);

            $fileName  = str_replace($namespaceSeparator, DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace($namespaceSeparator, DIRECTORY_SEPARATOR, $className) . $classExtension;

        include $fileName;
    }
}
