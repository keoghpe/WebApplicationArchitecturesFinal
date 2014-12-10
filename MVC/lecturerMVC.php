<?php

class LecturerMVCFactory extends MVCFactory
{
    function __construct() {
        parent::__construct();
        $this->type = "Lecturer";
    }
}

?>
