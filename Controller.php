<?php

/**
 * The controller in this application is responsible for
 * executing the appropriate action in the model.
 * The application has little business logic since
 * it mainly deals with flows of data.
 * A developer could modify the controller or extend it for
 * a particular route if they chose to add more business logic.
 */

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
