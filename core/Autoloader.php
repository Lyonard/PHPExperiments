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
        $namespaceSeparator = Registry::get('config')->get('INCLUDE_CONFIG')->get('namespaceSeparator');

        $className          = ltrim($className, $namespaceSeparator);

        $fileName = str_replace($namespaceSeparator, DIRECTORY_SEPARATOR, $className);

        include $fileName.".php";
    }
}
