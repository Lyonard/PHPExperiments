<?php
/**
 * Created by PhpStorm.
 * User: lavoro
 * Date: 30/06/14
 * Time: 17:14
 */

namespace core\mvc;


abstract class Controller {
    private $request;
    private $request_ENV;
    private $model;
    private $view;

    /**
     * @param string $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param array $request_ENV
     */
    public function setRequestENV($request_ENV)
    {
        $this->request_ENV = $request_ENV;
    }

    /**
     * @return array
     */
    public function getRequestENV()
    {
        return $this->request_ENV;
    }


    public abstract function doAction();
} 