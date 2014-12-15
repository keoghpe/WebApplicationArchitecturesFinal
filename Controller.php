<?php

class Controller{
    private $model;

    public function __construct($model, $action, $actions_params) {

        $this->model = $model;
        if ($action !== NULL) {
            switch ($action) {
                case "get":
                    $this->model->get($actions_params);
                    break;
                case "search":
                    $this->model->search($actions_params);
                    break;
                case "insert":
                    $this->model->insert($actions_params);
                    break;
                case "update":
                    $this->model->update($actions_params);
                    break;
                case "delete":
                    $this->model->delete($actions_params);
                    break;
            }
        }
    }
}

?>
