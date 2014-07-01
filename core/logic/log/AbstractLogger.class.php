<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 29/06/14
 * Time: 21.10
 */

namespace core\logic\log;


use SplSubject;

abstract class AbstractLogger implements ILogger, \SplObserver{

    public abstract function __construct();

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public abstract function emergency($message, array $context = array());

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
    public abstract function alert($message, array $context = array());

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public abstract function critical($message, array $context = array());

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public abstract function error($message, array $context = array());

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
    public abstract function warning($message, array $context = array());

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public abstract function notice($message, array $context = array());

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public abstract function info($message, array $context = array());

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public abstract function debug($message, array $context = array());

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array()){
        switch($level){
            case LogLevel::ALERT        : $this->alert($message, $context);
                                          break;
            case LogLevel::CRITICAL     : $this->critical($message, $context);
                                          break;
            case LogLevel::DEBUG        : $this->debug($message, $context);
                                          break;
            case LogLevel::EMERGENCY    : $this->emergency($message, $context);
                                          break;
            case LogLevel::ERROR        : $this->error($message, $context);
                                          break;
            case LogLevel::INFO         : $this->info($message, $context);
                                          break;
            case LogLevel::NOTICE       : $this->notice($message, $context);
                                          break;
            case LogLevel::WARNING      : $this->warning($message, $context);
                                          break;
            default                     : $this->warning($message, $context);
        }
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Receive update from subject
     * @link http://php.net/manual/en/splobserver.update.php
     * @param SplSubject $subject <p>
     * The <b>SplSubject</b> notifying the observer of an update.
     * </p>
     * @return void
     */
    public function update(SplSubject $subject, $event = null)
    {
        if($event == null){
            $this->log(LogLevel::INFO, "Event on ".get_class($subject));
        }
        else{
            $this->log(LogLevel::INFO, "Event: ".$event);
        }
    }
} 