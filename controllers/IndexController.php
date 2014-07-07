<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 06/07/14
 * Time: 2.25
 */

namespace controllers;


use core\mvc\Controller;
use models\IndexModel;
use views\IndexView;

class IndexController extends Controller{

    function __construct($request){
        $this->setModel( new IndexModel() );
        $this->setView( new IndexView() );
        $this->getModel()->attach( $this->getView() );
    }

    public function doAction()
    {
        $this->getModel()->setDummyName( "Roberto" );
        $this->getView()->render();
    }


}