<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/06/14
 * Time: 14.05
 */

namespace core;

use core\logic\exceptions\ConfigVarNotFoundException;

class Registry{

    /**
     * @var array
     */
    private static $vars;

    public static function init(){
        $config = parse_ini_file("res".DIRECTORY_SEPARATOR."config.ini", true);
        self::set('config', $config);
        self::set('ENV', array() );
    }

    /**
     * @param $key string
     * @return object
     * @throws \Exception
     */
    public static function get($key){
        if( !isset(self::$vars[$key])) throw new ConfigVarNotFoundException();

        if(is_array(self::$vars[$key])) return new ArrayClass(self::$vars[$key]);

        return self::$vars[$key];
    }

    /**
     * @param $key string
     * @param $value mixed
     */
    public static function set($key, $value){
        self::$vars[$key] = $value;
    }
}