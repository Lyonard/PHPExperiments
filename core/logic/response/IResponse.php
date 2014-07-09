<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 09/07/14
 * Time: 15.12
 */

namespace core\logic\response;


interface IResponse {

    public function setData($data);

    public function getResponse();

}