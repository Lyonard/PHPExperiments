<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 29/06/14
 * Time: 21.22
 */

namespace core\log;


use core\Config;
use SplSubject;

class FileLogger extends AbstractLogger{

    private $filePath;
    private static $DEFAULT_FILE_PATH;

    public function __construct($filePath = null){
        date_default_timezone_set("Europe/Rome");
        self::$DEFAULT_FILE_PATH = Config::$defaultLogFilePath;

        if($filePath == null) $filePath = self::$DEFAULT_FILE_PATH;

        $this->filePath = $filePath;
    }


    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function emergency($message, array $context = array())
    {
        file_put_contents(
            $this->filePath, "[".date("Y-m-d H:i:s")."] [EMERGENCY]".$message. PHP_EOL, FILE_APPEND
        );
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function alert($message, array $context = array())
    {
        file_put_contents(
            $this->filePath, "[".date("Y-m-d H:i:s")."] [ALERT]".$message. PHP_EOL, FILE_APPEND
        );
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function critical($message, array $context = array())
    {
        file_put_contents(
            $this->filePath, "[".date("Y-m-d H:i:s")."] [CRITICAL]".$message. PHP_EOL, FILE_APPEND
        );
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function error($message, array $context = array())
    {
        file_put_contents(
            $this->filePath, "[".date("Y-m-d H:i:s")."] [ERROR]".$message. PHP_EOL, FILE_APPEND
        );
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function warning($message, array $context = array())
    {
        file_put_contents(
            $this->filePath, "[".date("Y-m-d H:i:s")."] [WARNING]".$message. PHP_EOL, FILE_APPEND
        );
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function notice($message, array $context = array())
    {
        file_put_contents(
            $this->filePath, "[".date("Y-m-d H:i:s")."] [NOTICE]".$message. PHP_EOL, FILE_APPEND
        );
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function info($message, array $context = array())
    {
        file_put_contents(
            $this->filePath, "[".date("Y-m-d H:i:s")."] [INFO]".$message. PHP_EOL, FILE_APPEND
        );
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function debug($message, array $context = array())
    {
        file_put_contents(
            $this->filePath, "[".date("Y-m-d H:i:s")."] [DEBUG]".$message. PHP_EOL, FILE_APPEND
        );
    }
} 