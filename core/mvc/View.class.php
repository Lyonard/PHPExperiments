<?php
/**
 * Created by PhpStorm.
 * User: lavoro
 * Date: 30/06/14
 * Time: 17:14
 */

namespace core\mvc;


use SplSubject;

abstract class View implements \SplObserver{
    private $template;
    private $templateVariables;

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Receive update from subject
     * @link http://php.net/manual/en/splobserver.update.php
     * @param SplSubject $subject <p>
     * The <b>SplSubject</b> notifying the observer of an update.
     * </p>
     * @return void
     */
    public abstract function update(SplSubject $subject);
} 