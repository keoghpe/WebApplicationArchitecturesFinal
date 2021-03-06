<?php

require_once("Validator.php");
require_once("InvalidInputException.php");

abstract class Model {

    protected $DAO, $resultsList, $template, $validator, $conditions_types;

    function __construct($aDAO)
    {
        $this->DAO = $aDAO;
        $this->validator = new Validator();
        $this->conditions_types = array("limit" => "integer", "offset" => "integer", "fields"=>"comma_separated_string");
    }

    public function get($params_array){

        try{
            if($params_array["conditions"] !== null)
                $params_array["conditions"] = $this->validate($params_array["conditions"], $this->conditions_types);

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
                $params_array["conditions"] = $this->validate($params_array["conditions"], $this->conditions_types);

            if($params_array["params"] !== null)
                $params_array["params"] = $this->validate($params_array["params"], $this->types);

            $this->resultsList = $this->DAO->search($params_array, $this->types);
        } catch(InvalidInputException $e){
            $this->resultsList = $e->getExceptions();
        }
    }


    public function insert($params_array){
        try{
            $params_array["params"] = $this->validate($params_array["params"], $this->types);
            $this->resultsList = $this->DAO->insert($params_array);
        } catch(InvalidInputException $e){
            $this->resultsList = $e->getExceptions();
        }
    }


    public function delete($params_array){
        try{
            $params = $this->validate($params_array["params"], $this->types);
            $this->resultsList = $this->DAO->delete($params);
        } catch(InvalidInputException $e){
            $this->resultsList = $e->getExceptions();
        }

    }


    public function update($params_array){
        try{
            //echo var_dump($params_array);

            $params_array["params"] = $this->validate($params_array["params"], $this->types);
            $this->resultsList = $this->DAO->update($params_array);
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

                if($key === "fields"){
                    $this->validator->validate_fields($value, $this->types);
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
