<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 06/07/14
 * Time: 16.34
 */

namespace views;


use core\logic\response\HtmlResponse;
use core\logic\response\ResponseFactory;
use core\mvc\View;
use core\Registry;
use models\IndexModel;
use SplSubject;

class IndexView extends View{

    public function __construct(){
        $this->setTemplateName("index.html");
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
    public function update(SplSubject $subject)
    {
        if($subject instanceof IndexModel){
            $templateVars = $this->getTemplateVariables();
            $templateVars['dummyName'] = $subject->getDummyName();
            $this->setTemplateVariables($templateVars);
        }
    }

    public function render()
    {
        $responseFactory = ResponseFactory::getInstance();

        $responseObj = $responseFactory->getResponseObject( Registry::get('ENV')->get('responseType') );

        if($responseObj instanceof HtmlResponse){
            $responseObj->setTemplateName( $this->getTemplateName() );
        }

        echo $responseObj->getResponse();
    }
}