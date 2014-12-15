<?php
/**
 * @author keoghpe
 *
 * The purpose of this exception is to collect the output of multiple exceptions
 * that may be thrown as a result of invalid user input.
 * All of the exceptions can then be returned in an array to the user.
 *
 */

class InvalidInputException extends Exception {

    private $exceptions;

    function __construct() {
        $this->exceptions = array();
    }

    public function addException(Exception $e) {
        array_push($this->exceptions, $e->getMessage());
    }

    public function getExceptions() {
        return $this->exceptions;
    }
}
?>
