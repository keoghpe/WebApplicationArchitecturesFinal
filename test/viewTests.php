<?php

require_once('../simpletest/autorun.php');

class ViewTest extends UnitTestCase {

    private $view;
    private $exception;

    public function setUp(){
        require_once('../View.php');
        $this->model = new MockModel();
        $this->view = new View($this->model, "resource");
    }


    public function testOutput(){
        $this->assertEqual($this->view->output(),'[{"key":"value","otherkey":"othervalue"},{"key":"value","otherkey":"othervalue"}]');
        $this->assertEqual($this->view->output("json"),'[{"key":"value","otherkey":"othervalue"},{"key":"value","otherkey":"othervalue"}]');
        $this->assertEqual($this->view->output("something"),'[{"key":"value","otherkey":"othervalue"},{"key":"value","otherkey":"othervalue"}]');
        $this->assertEqual($this->view->output("csv"),"key, otherkey\nvalue, othervalue\nvalue, othervalue\n");
        $this->assertEqual($this->view->output("xml"),"<?xml version=\"1.0\"?>\n<response><resource0><key>value</key><otherkey>othervalue</otherkey></resource0><resource1><key>value</key><otherkey>othervalue</otherkey></resource1></response>\n");
    }

    public function tearDown(){
        $this->view = null;
    }
}

class MockModel{
    public function output(){
        return [["key"=>"value","otherkey"=>"othervalue"],["key"=>"value","otherkey"=>"othervalue"]];
    }
}
?>
