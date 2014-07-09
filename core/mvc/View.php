<?php
/**
 * Created by PhpStorm.
 * User: lavoro
 * Date: 30/06/14
 * Time: 17:14
 */

namespace core\mvc;

use core\Registry;
use SplSubject;

abstract class View implements \SplObserver{

    private $template;
    private $templateVariables;
    private $twig;
    /**
     * @var boolean
     */
    private $ajax;
    /**
     * @var string
     */
    private $responseType;

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
    public abstract function render();

    /**
     * @return \Twig_Environment
     */
    protected function getTwig(){
        if($this->twig == null)
            $this->loadTwig();

        return $this->twig;
    }

    private function loadTwig(){
        $registry = Registry::getInstance();
        $loader = new \Twig_Loader_Filesystem($registry['config']['USER_FOLDERS']['templates']);

        $this->twig = new \Twig_Environment($loader);
    }

    /**
     * @param array $templateVariables
     */
    protected function setTemplateVariables($templateVariables)
    {
        $this->templateVariables = $templateVariables;
    }

    /**
     * @return array
     */
    protected function getTemplateVariables()
    {
        return $this->templateVariables;
    }

    /**
     * @param boolean $ajax
     */
    public function setAjax($ajax)
    {
        $this->ajax = $ajax;
    }

    /**
     * @return boolean
     */
    public function getAjax()
    {
        return $this->ajax;
    }

    /**
     * @param string $responseType
     */
    public function setResponseType($responseType)
    {
        $this->responseType = $responseType;
    }

    /**
     * @return string
     */
    public function getResponseType()
    {
        return $this->responseType;
    }
} 