<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 06/07/14
 * Time: 16.34
 */

namespace models;

use core\mvc\Model;

class IndexModel extends Model{
    private $dummyName;

    /**
     * @param mixed $dummyName
     */
    public function setDummyName($dummyName)
    {
        $this->dummyName = $dummyName;
        $this->notify();
    }

    /**
     * @return mixed
     */
    public function getDummyName()
    {
        return $this->dummyName;
    }


} 