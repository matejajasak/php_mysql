<?php

abstract class Page{

    private $html;

    abstract protected function getHtml();

    public function printOut(){

        echo $this->getHtml();
    }
}

class HomePage extends Page {

    public function getHtml(){
        return '<h1>Abstract class</h1>';
    }
}
//kod abstraktivnih klasa se može instancirati samo klasa koja nasljeđuje abstraktnu klasu

$obj = new HomePage();
$obj->printOut();