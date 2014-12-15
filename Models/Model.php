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

    public function get($params_array){

        $conditions_types = array("limit" => "integer", "offset" => "integer");

        try{
            if($params_array["conditions"] !== null)
                $params_array["conditions"] = $this->validate($params_array["conditions"], $conditions_types);

            if($params_array["params"] !== null)
                $params_array["params"] = $this->validate($params_array["params"], $this->types);

            $this->resultsList = $this->DAO->get($params_array);
        } catch(InvalidInputException $e){
            $this->resultsList = $e->getExceptions();
        }
    }
    public function search($params_array){

        try{
            if($params_array["conditions"] !== null)
                $params_array["conditions"] = $this->validate($params_array["conditions"], $conditions_types);

            if($params_array["params"] !== null)
                $params_array["params"] = $this->validate($params_array["params"], $this->types);

            $this->resultsList = $this->DAO->search($params_array["query"],$this->template);
        } catch(InvalidInputException $e){
            $this->resultsList = $e->getExceptions();
        }
    }
    public function insert($params){
        try{
            $params = $this->validate($params, $this->types);
            $this->resultsList = $this->DAO->insert($params);
        } catch(InvalidInputException $e){
            $this->resultsList = $e->getExceptions();
        }
    }
    public function delete($params){
        try{
            $params = $this->validate($params, $this->types);
            $this->resultsList = $this->DAO->delete($params);
        } catch(InvalidInputException $e){
            $this->resultsList = $e->getExceptions();
        }

    }
    public function update($params){
        try{
            $params = $this->validate($params, $this->types);
            $this->resultsList = $this->DAO->update($params);
        } catch(InvalidInputException $e){
            $this->resultsList = $e->getExceptions();
        }
    }
    public function output(){

        return $this->resultsList;
    }

    protected function validate($params, $typesArray){

        $invalidInputException = null;
        $validatedInputs = array();

        foreach($params as $key => $value){

            try{
                if(!array_key_exists($key, $typesArray)){
                    throw new Exception("Cannot access field $key associated with this table",1);
                }
                $this->validator->validate($value, $typesArray[$key]);
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
