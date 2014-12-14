<?php

require_once('../simpletest/autorun.php');

class ValidatorTest extends UnitTestCase {

    private $validator;
    private $exception;

    public function setUp(){
        require_once('../Models/Validator.php');
        $this->validator = new Validator();
        $this->exception = new Exception("Error Processing Request", 1);
    }

    public function testParagraph(){

    }

    public function testDate(){
        $this->assertTrue($this->validator->validate("2014-02-12","date"));
        $this->assertTrue($this->validator->validate("2014-02-31","date"));
        $this->assertTrue($this->validator->validate("2014-12-25","date"));
        $this->assertTrue($this->validator->validate("2014-05-02","date"));

        $this->testException("02-05-2014","date");
        $this->testException("2014/05/02","date");
        $this->testException("14-05-02","date");
        $this->testException("","date");
    }

    public function testInteger(){
        $this->assertTrue($this->validator->validate("1","integer"));
        $this->assertTrue($this->validator->validate("345","integer"));
        $this->assertTrue($this->validator->validate("000","integer"));
        $this->assertTrue($this->validator->validate("12496547409678675","integer"));

        $this->testException("       ","integer");
        $this->testException("!!!!","integer");
        $this->testException(") (","integer");
        $this->testException("","integer");

    }

    public function testTimeInterval(){
        $this->assertTrue($this->validator->validate("12:00-13:00","timeinterval"));
        $this->assertTrue($this->validator->validate("12:30-13:30","timeinterval"));
        $this->assertTrue($this->validator->validate("13:00-16:00","timeinterval"));
        $this->assertTrue($this->validator->validate("12:00-18:50","timeinterval"));

        $this->testException("32:00-33:00","timeinterval");
        $this->testException("12:70-13:70","timeinterval");
        $this->testException("12:00-13:0f","timeinterval");
        $this->testException("12:00--13:00","timeinterval");
    }

    public function testHex()
    {
        $this->assertTrue($this->validator->validate("23f","hex"));
        $this->assertTrue($this->validator->validate("2345fecd","hex"));
        $this->assertTrue($this->validator->validate("aaa","hex"));
        $this->assertTrue($this->validator->validate("fffffff143252345fffffff112432543456","hex"));

        $this->testException("ggggggggg","hex");
        $this->testException("!!!!","hex");
        $this->testException(") (","hex");
        $this->testException("","hex");
    }

    public function tearDown(){
        $this->validator = null;
    }

    private function testException($input, $type){
        try{
            $this->validator->validate($input,$type);
            $this->fail("Expected Exception");
        } catch(Exception $e) {
            $this->pass("Caught Exception");
        }

    }
}
?>
