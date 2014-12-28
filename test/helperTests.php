<?php

require_once('../simpletest/autorun.php');

class IndexTest extends UnitTestCase {

    private $view;

    public function setUp(){
        require_once('../helper.php');
        require_once('../View.php');

        $view = new View();
    }

    public function testGetDataType(){
        \helper\getDataType();
    }

    public function tearDown(){
        $this->validator = null;
    }
}
?>
