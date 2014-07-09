<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 06/07/14
 * Time: 3.13
 */

namespace views;

use core\logic\response\HtmlResponse;
use core\logic\response\ResponseFactory;
use core\mvc\View;
use core\Registry;
use SplSubject;

class ErrorPageView extends View{

    private $errorCode;

    public function __construct(){ }

    /**
     * @param $errCode int
     */
    public function setErrorCode($errCode){
        $this->errorCode = (int)$errCode;
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
    public function update(SplSubject $subject){}

    public function render()
    {
        $registry = Registry::getInstance();

        $responseFactory = ResponseFactory::getInstance();

        $responseObj = $responseFactory->getResponseObject( $registry['ENV']['responseType'] );

        if($responseObj instanceof HtmlResponse)
            $responseObj -> setTemplateName($this->errorCode.".html");

        echo $responseObj->getResponse();
    }


} 