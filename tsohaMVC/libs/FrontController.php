<?php

class FrontController {

    private $_url = null;
    private $_controller = null;

    public function run() {
        $this->_getUrl();
        if (empty($this->_url[0])) {
            $this->_loadDefController();
            return false;
        }

        $this->_loadController();
        $this->_callControllerMethod();
    }

    private function _getUrl() {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $this->_url = explode('/', $url);
        } else {
            $url = null;
        }
    }

    private function _loadDefController() {
        require "controllers/index.php";
        $this->_controller = new Index();
        $this->_controller->index();
    }

    private function _loadController() {
        $file = 'controllers/' . $this->_url[0] . '.php';
        if (file_exists($file)) {
            require $file;
            $this->_controller = new $this->_url[0];
            $this->_controller->loadModel($this->_url[0]);
        } else {
            $this->_error();
            exit;
        }
    }

    private function _callControllerMethod() {
        $length = count($this->_url);

        if ($length > 1) {
            if (!method_exists($this->_controller, $this->_url[1])) {
                $this->_error();
            }
        }

        if ($length == 4) {
            $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
        } else if ($length == 3) {
            $this->_controller->{$this->_url[1]}($this->_url[2]);
        } else if ($length == 2) {
            $this->_controller->{$this->_url[1]}();
        } else {
            $this->_controller->index();
        }
    }

    private function _error() {
        require 'controllers/error.php';
        $this->_controller = new Error();
        $this->_controller->index();
        return false;
    }

}