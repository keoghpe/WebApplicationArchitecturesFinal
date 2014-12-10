<?php

class Model {
    private $DAO, $resultsList;

    function __construct($aDAO)
    {
        $this->DAO = $aDAO;
    }

    public function get($params=null){
        $this->resultsList = $this->DAO->get($params);
    }
    public function search($params){
        $this->resultsList = $this->DAO->search($params);
    }
    public function insert($params){
        $this->resultsList = $this->DAO->insert($params);
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
}

?>
