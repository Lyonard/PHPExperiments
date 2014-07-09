<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 09/07/14
 * Time: 15.13
 */

namespace core\logic\response;


class JsonResponse implements IResponse{
    private $data;

    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return json_encode($this->data);
    }

} 