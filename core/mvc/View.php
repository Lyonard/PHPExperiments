<?php
/**
 * Created by PhpStorm.
 * User: lavoro
 * Date: 30/06/14
 * Time: 17:14
 */

namespace core\mvc;

use core\logic\response\HtmlResponse;
use core\logic\response\ResponseFactory;
use core\Registry;
use SplSubject;

abstract class View implements \SplObserver{

    /**
     * @var string
     */
    private $templateName;
    /**
     * @var array
     */
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
     * @param string $templateName
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
    }

    /**
     * @return string
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

    public function render()
    {
        $responseFactory = ResponseFactory::getInstance();

        $responseObj = $responseFactory->getResponseObject( Registry::get('ENV')->get('responseType') );

        if($responseObj instanceof HtmlResponse)
            $responseObj -> setTemplateName($this->getTemplateName().".html");

        if($this->getTemplateVariables() != null && count($this->getTemplateVariables()) > 0)
            $responseObj -> setData($this->getTemplateVariables());

        echo $responseObj->getResponse();
    }
} 