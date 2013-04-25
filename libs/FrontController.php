<?php

class FrontController {

    private $_url = null;
    private $_controller = null;
    private $_action = null;
    private $_params = array();

    public function run() {
        $this->_parseUrl();
        if (!isset($this->_url) || empty($this->_url[0])) {
            $this->_setController("index");
            $this->_controller->index();
            return false;
        }
        $this->_setController($this->_url[0]);
        $this->_controllerMethod();
    }

    // Luetaan index.php?url= perässä olevat parametrit "/" erotettuna url taulukkoon
    private function _parseUrl() {
        if (isset($_GET['url'])) {
            $this->_url = explode('/', strtolower(filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)));
        } else {
            $url = null;
        }
    }

    private function _setController($controller) {
        $filePath = 'controllers/' . $controller . '.php';
        if (file_exists($filePath)) {
            require $filePath;
            $this->_controller = new $controller;
            $this->_controller->loadModel($controller);
        } else {
            $this->_error();
            exit;
        }
    }

    /**
     * Kutsutaan oikeaa kontrolleria oikealla määrällä parametreja.
     */
    private function _controllerMethod() {
        if (count($this->_url) > 1 && method_exists($this->_controller, $this->_url[1])) {
            $this->_action = $this->_url[1];
            $this->_setParameters();
            $this->_callMethod();
        } else if (count($this->_url) > 1 && !method_exists($this->_controller, $this->_url[1])) {
            $this->_error();
        } else {
            $this->_controller->index();
        }
    }

    private function _callMethod() {
        $parameters_length = count($this->_params);
        if ($parameters_length == 3) {
            $this->_controller->{$this->_action}($this->_params[0], $this->_params[1], $this->_params[2]);
        } else if ($parameters_length == 2) {
            $this->_controller->{$this->_action}($this->_params[0], $this->_params[1]);
        } else if ($parameters_length == 1) {
            $this->_controller->{$this->_action}($this->_params[0]);
        } else {
            $this->_controller->{$this->_action}();
        }
    }

    // Virhesivun renderöinti
    private function _error() {
        require 'controllers/error.php';
        $this->_controller = new Error();
        $this->_controller->index();
        return false;
    }

    public function _setParameters() {
        for ($i = 2; $i < count($this->_url); $i++) {
            $this->_params[$i - 2] = $this->_url[$i];
        }
    }

}