<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/06/14
 * Time: 14.05
 */

namespace core;


class Config {

    /**
     * @var String
     */
    public static $classExtension;

    /**
     * @var char
     */
    public static $namespaceSeparator;

    /**
     * @var String
     */
    public static $displayErrors;

    /**
     * @var String
     */
    public static $autoloader;
    /**
     * @var String
     */
    public static $autoloaderCompleteClassName;

    /**
     * @var String
     */
    public static $errorHandler;
    /**
     * @var String
     */
    public static $errorHandlerCompleteClassName;

    /**
     * @var String
     */
    public static $exceptionHandlerCompleteClassName;

    /**
     * @var String
     */
    public static $defaultLogFilePath;

    /**
     * @var array
     */
    public static $activeLogs;

    /**
     * @var array AbstractLogger
     */
    public static $loggers;

    public static function init(){
        $config = parse_ini_file("res".DIRECTORY_SEPARATOR."config.ini");

        self::$classExtension       = $config['classExtension'];
        self::$namespaceSeparator   = $config['namespaceSeparator'];

        self::$displayErrors        = $config['display_errors'];

        /**
         * Autoloader
         */
        self::$autoloader                   = $config['autoloaderClass'];
        self::$autoloaderCompleteClassName  = $config['autoloaderNameSpace'];

        /**
         * Error Handler
         */
        self::$errorHandlerCompleteClassName    = $config['errorHandlerNameSpace'];

        /**
         * Exception Handler
         */
        self::$exceptionHandlerCompleteClassName = $config['exceptionHandlerNameSpace'];

        /**
         * Logging to file
         */
        self::$defaultLogFilePath               = $config['default_file_path'];

        /**
         * Loggers
         */
        self::$activeLogs = array(
            "File"          =>  $config['file_log'],
            "Mysql"         =>  $config['mysql_log']
        );

        self::$loggers = array();
    }
}