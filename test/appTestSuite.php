<?php
require_once('../simpletest/autorun.php');

class AppTestSuite extends TestSuite{
    function __construct(){
        parent::__construct();
        $this->addFile('validatorTests.php');
        $this->addFile('helperTests.php');
    }
}
