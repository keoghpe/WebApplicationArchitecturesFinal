<?php

class Model {
    protected $DAO, $resultsList, $template;

    function __construct($aDAO)
    {
        $this->DAO = $aDAO;
    }

    public function get($id=null,$params=null,$related_resource=null){
        $this->resultsList = $this->DAO->get($id, $params, $related_resource);
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
