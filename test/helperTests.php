<?php

require_once('../simpletest/autorun.php');

class helperTests extends UnitTestCase {

    private $view;

    public function setUp(){
        require_once('../helper.php');
        //require_once('../View.php');

        $this->view = new MockView();
    }

    public function testSingularify(){
        $this->assertEqual(\helper\singularify("things"),"Thing");
        $this->assertEqual(\helper\singularify("families"),"Family");
        $this->assertEqual(\helper\singularify("tables"),"Table");
        $this->assertEqual(\helper\singularify("personalities"),"Personality");
    }

    public function testArray_and_key_exist(){
        $this->assertTrue(\helper\array_and_key_exist(array("mykey"=>"myvalue"),"mykey"));
        $this->assertFalse(\helper\array_and_key_exist(null,"mykey"));
        $this->assertTrue(\helper\array_and_key_exist(["mykey"=>"myvalue"],"mykey"));
        $this->assertFalse(\helper\array_and_key_exist(1,"mykey"));
    }

    public function test_clean_request(){
        $params = array("id"=>1,
                "query"=>null,
                "params"=>null,
                "conditions"=>null,
                "related"=>null);
        $params_with_query = array("id"=>null,
                "query"=>"somethign",
                "params"=>null,
                "conditions"=>null,
                "related"=>null);

        $this->assertEqual(\helper\clean_request('GET',$params),"get");
        //$this->assertEqual(\helper\clean_request('GET',$params_with_query),"search");
        $this->assertEqual(\helper\clean_request('PUT',$params_with_query),"update");
        $this->assertEqual(\helper\clean_request('POST',$params_with_query),"insert");
        $this->assertEqual(\helper\clean_request('DELETE',$params_with_query),"delete");
        $this->testException('POST',$params);
        $this->testException('OPTIONS',$params);

    }

    public function testGetDatatype(){
        $var = array("datatype"=>"csv");
        $this->assertEqual(\helper\getDatatype($var, $this->view),"csv");
        $var = array("datatype"=>"xml");
        $this->assertEqual(\helper\getDatatype($var, $this->view),"xml");
        $var = array("datatype"=>"json");
        $this->assertEqual(\helper\getDatatype($var, $this->view),"json");
        $var = array("datatype"=>"anythingelse");
        $this->assertEqual(\helper\getDatatype($var, $this->view),"json");
        $var = array("datatype"=>1);
        $this->assertEqual(\helper\getDatatype($var, $this->view),"json");
    }

    public function tearDown(){

    }

    private function testException($req, $params){
        try{
            \helper\clean_request($req,$params);
            $this->fail("Expected Exception");
        } catch(Exception $e) {
            $this->pass("Caught Exception");
        }
    }
}


class MockView {
    public function getAvailableDatatypes(){
        return array("xml","json","csv");
    }
}
?>
