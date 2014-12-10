<?php

class Controller{
    private $model;

    public function __construct($model, $action, $id, $parameters, $related_resource=null) {

        $this->model = $model;
        if ($action !== NULL) {
            switch ($action) {
                case "get":
                    $this->model->get($id, $parameters, $related_resource);
                    break;
                case "search":
                    $this->model->search($parameters);
                    break;
                case "insert":
                    $this->model->insert($parameters);
                    break;
                case "update":
                    $this->model->update($parameters);
                    break;
                case "delete":
                    $this->model->delete($parameters);
                    break;
            }
        }
    }
}

?>
