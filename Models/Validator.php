<?php

/**
 *
 */
class Validator
{
    private $validation_regs;
    function __construct()
    {
        $this->validation_regs = array(
            "integer" => "/^[\d]+$/",
            "hex" => "/^[\da-fA-F]+$/",
            "date" => "/^\d\d\d\d-\d\d-\d\d$/",
            "timeinterval" => "/^([01]\d|2[0-3]):[0-5]\d-([01]\d|2[0-3]):[0-5]\d$/",
        );
    }

    public function validate($input, $type){
        if(array_key_exists($type, $this->validation_regs)){
            if (preg_match($this->validation_regs[$type], $input)){
                return true;
            } else {
                throw new Exception("Error: is not $input a valid $type", 1);
            }

        } else {
            throw new Exception("Error: there is no type: $type", 1);
        }
    }
}



?>
