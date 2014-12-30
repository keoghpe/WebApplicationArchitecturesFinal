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
            "comma_separated_string" => "/^[\w_,]+$/",
            "alphanumeric" => "/^[\w\d ]+$/",
            "paragraph" => "/.*/"
        );
    }

    public function validate($input, $type){
        if(array_key_exists($type, $this->validation_regs)){
            if (preg_match($this->validation_regs[$type], $input)){
                return true;
            } else {
                throw new Exception("Error: $input is not a valid $type", 1);
            }

        } else {
            throw new Exception("Error: there is no type: $type", 1);
        }
    }

    public function validate_fields($fields, $types){
        $fields_array = explode(',',$fields);

        foreach ($fields_array as $key => $value) {
            if(!array_key_exists($value,$types)){
                throw new Exception("Error: there's no field: $value", 1);
            }
        }

        return true;
    }
}



?>
