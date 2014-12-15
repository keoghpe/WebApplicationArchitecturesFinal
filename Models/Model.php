<?php

require_once("Validator.php");
require_once("InvalidInputException.php");

abstract class Model {

    protected $DAO, $resultsList, $template, $validator;

    function __construct($aDAO)
    {
        $this->DAO = $aDAO;
        $this->validator = new Validator();
    }

    public function get($id=null,$params=null,$related_resource=null){

        $this->resultsList = $this->DAO->get($id, $params, $related_resource);
    }
    public function search($params){

        $this->resultsList = $this->DAO->search($params);
    }
    public function insert($params){
        try{
            $clean_params = $this->validate($params);
            $this->resultsList = $this->DAO->insert($clean_params);
        } catch(InvalidInputException $e){
            $this->resultsList = $e->getExceptions();
        }
    }
    public function delete($params){

        $this->resultsList = $this->DAO->delete($params);
    }
    public function update($params){

        $this->resultsList = $this->DAO->update($params);
    }
    public function output(){

        return $this->resultsList;
    }

    protected function validate($params){

        $invalidInputException = null;
        $validatedInputs = array();

        foreach($params as $key => $value){

            try{
                if(!array_key_exists($key, $this->types)){
                    throw new Exception("There is no field $key associated with this table",1);
                }
                $this->validator->validate($value, $this->types[$key]);
                $validatedInputs[$key] = $value;
            } catch (Exception $e){
                if($invalidInputException === null){
                    $invalidInputException = new InvalidInputException();
                }
                $invalidInputException->addException($e);
            }
        }
        
        if($invalidInputException !== null){
            throw $invalidInputException;
        }

        return $validatedInputs;

    }
}

?>
