<?php

class StudentMVCFactory extends MVCFactory
{
    function __construct() {
        parent::__construct();
        $this->type = "Student";
    }
}

?>
