<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/06/14
 * Time: 14.05
 */

namespace core;


class Registry implements \ArrayAccess{

    /**
     * @var Registry
     */
    private static $instance;

    /**
     * @var array
     */
    private $registry;

    private function __construct(){

    }

    /**
     * @return Registry
     */
    public static function getInstance(){
        if(self::$instance == null) self::$instance = new Registry();

        return self::$instance;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return isset($this->registry[$offset]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        if(isset($this->registry[$offset]))
            return $this->registry[$offset];
        throw new \Exception("Offset $offset not found");
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->registry[$offset] = $value;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->registry[$offset]);
    }

//
//    /**
//     * @var String
//     */
//    public static $classExtension;
//
//    /**
//     * @var char
//     */
//    public static $namespaceSeparator;
//
//    /**
//     * @var String
//     */
//    public static $displayErrors;
//
//    /**
//     * @var String
//     */
//    public static $autoloader;
//    /**
//     * @var String
//     */
//    public static $autoloaderCompleteClassName;
//
//    /**
//     * @var string
//     */
//    public static $twigAutoloaderCompleteClassName;
//
//    /**
//     * @var String
//     */
//    public static $errorHandler;
//    /**
//     * @var String
//     */
//    public static $errorHandlerCompleteClassName;
//
//    /**
//     * @var String
//     */
//    public static $exceptionHandlerCompleteClassName;
//
//    /**
//     * @var String
//     */
//    public static $loggerCompleteClassName;
//    /**
//     * @var String
//     */
//    public static $defaultLogFilePath;
//
//    public static $loggerConfigFilePath;
//
//    /**
//     * @var string
//     */
//    public static $ajaxRequestActionName;
//
//    /**
//     * @var array
//     */
//    public static $userFolders;
//
    public function init(){
        $config = parse_ini_file("res".DIRECTORY_SEPARATOR."config.ini", true);
        $this->offsetSet("config", $config);

//
//        self::$classExtension       = $config['classExtension'];
//        self::$namespaceSeparator   = $config['namespaceSeparator'];
//
//        self::$displayErrors        = $config['display_errors'];
//
//        /**
//         * Autoloader
//         */
//        self::$autoloader                       = $config['autoloaderClass'];
//        self::$autoloaderCompleteClassName      = $config['autoloaderNameSpace'];
//        self::$twigAutoloaderCompleteClassName  = $config['twigLoaderNameSpace'];
//
//        /**
//         * Error Handler
//         */
//        self::$errorHandlerCompleteClassName    = $config['errorHandlerNameSpace'];
//
//        /**
//         * Exception Handler
//         */
//        self::$exceptionHandlerCompleteClassName    = $config['exceptionHandlerNameSpace'];
//
//        /**
//         * Logger by log4php
//         */
//        self::$loggerCompleteClassName              = $config['loggerNameSpace'];
//        self::$defaultLogFilePath                   = $config['default_file_path'];
//        self::$loggerConfigFilePath                 = $config['loggerConfig'];
//
//        /**
//         * Ajax request in URL
//         */
//        self::$ajaxRequestActionName                = $config['ajax_request_action_name'];
//
//        /**
//         * User folders
//         */
//        self::$userFolders = array(
//            'model'         =>  $config['user_models_folder'],
//            'view'          =>  $config['user_views_folder'],
//            'controller'    =>  $config['user_controllers_folder'],
//            'root'          =>  $config['root_folder'],
//            'templates'     =>  $config['user_templates_folder']
//        );
    }
}