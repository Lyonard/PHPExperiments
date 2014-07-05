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
    public static $loggerCompleteClassName;
    /**
     * @var String
     */
    public static $defaultLogFilePath;

    public static $loggerConfigFilePath;

    /**
     * @var string
     */
    public static $ajaxRequestActionName;

    /**
     * @var array
     */
    public static $userFolders;

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
        self::$exceptionHandlerCompleteClassName    = $config['exceptionHandlerNameSpace'];

        /**
         * Logger by log4php
         */
        self::$loggerCompleteClassName              = $config['loggerNameSpace'];
        self::$defaultLogFilePath                   = $config['default_file_path'];
        self::$loggerConfigFilePath                 = $config['loggerConfig'];

        /**
         * Ajax request in URL
         */
        self::$ajaxRequestActionName                = $config['ajax_request_action_name'];

        /**
         * User folders
         */
        self::$userFolders = array(
            'model'         =>  $config['user_models_folder'],
            'view'          =>  $config['user_views_folder'],
            'controller'    =>  $config['user_controllers_folder'],
            'root'          =>  $config['root_folder']
        );
    }
}