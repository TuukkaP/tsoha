<?php
require_once LIBS.'View.php';

class Controller {
    
    public function __construct() {
        $this->view = new View();
    }

    public function loadModel($name) {

        $path = 'models/' . $name . 'Model.php';

        if (file_exists($path)) {
            require 'models/' . $name . 'Model.php';

            $modelName = $name . 'Model';
            $this->model = new $modelName();
        }
    }
    
}

