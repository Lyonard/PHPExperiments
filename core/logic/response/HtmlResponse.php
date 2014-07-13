<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 09/07/14
 * Time: 15.17
 */

namespace core\logic\response;


use core\Registry;

class HtmlResponse implements IResponse{

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $templateName;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(){
        $this->loadTwig();
    }

    /**
     * @return \Twig_Environment
     */
    private function getTwig(){
        if($this->twig == null)
            $this->loadTwig();

        return $this->twig;
    }

    private function loadTwig(){
        $loader = new \Twig_Loader_Filesystem(Registry::get('config')->get('USER_FOLDERS')->get('templates'));

        $this->twig = new \Twig_Environment($loader);
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
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

    public function getResponse()
    {
        return
            $this->getTwig()->render(
                $this->getTemplateName(),
                ($this->getData() == null) ? array() : $this->getData()
            );
    }



} 