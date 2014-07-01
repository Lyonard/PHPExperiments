<?php
/**
 * Created by PhpStorm.
 * User: lavoro
 * Date: 30/06/14
 * Time: 17:14
 */

namespace core\mvc;


use SplObserver;

abstract class Model implements \SplSubject{

    private $observers;

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Attach an SplObserver
     * @link http://php.net/manual/en/splsubject.attach.php
     * @param SplObserver $observer <p>
     * The <b>SplObserver</b> to attach.
     * </p>
     * @return void
     */
    public function attach(SplObserver $observer, $event = null)
    {
        if($event == null) $event = 'all';

        if(in_array($event, self::$events)){
            $this->observers[$event][] = $observer;
        }
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Detach an observer
     * @link http://php.net/manual/en/splsubject.detach.php
     * @param SplObserver $observer <p>
     * The <b>SplObserver</b> to detach.
     * </p>
     * @return void
     */
    public function detach(SplObserver $observer, $event = null)
    {
        if($event == null) $event = 'all';

        if(in_array($event, self::$events)){
            $key = array_search($observer,$this->observers, true);
            if($key){
                unset($this->observers[$key]);
            }
        }
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Notify an observer
     * @link http://php.net/manual/en/splsubject.notify.php
     * @return void
     */
    public function notify($event = null)
    {
        if($event == null) $event = 'all';

        if(in_array($event, self::$events)){
            foreach($this->observers[$event] as $value) {
                $value->update($this, $event);
            }
        }
    }
} 