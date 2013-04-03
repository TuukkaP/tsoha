<?php

class Bootstrap {

    function __construct() {

        if (isset($_GET['url'])) {
            // Otetaan turhat merkit pois urlista ja tarkistetaan muoto, jaetaan url-arrayhin, jako / - merkistä.
            $url = strtolower(filter_var($_GET['url'], FILTER_SANITIZE_URL));
            $url = rtrim($url, '/');
            $url = explode('/', $url);
        } else {
            $url = null;
        }
        print_r($url);
        
        //Jos ei tule syötettä mennään indexControlleriin.

        if (empty($url[0])) {
            require 'controllers/index.php';
            $controller = new Index();
            $controller->index();
            return false;
        }
        $file = 'controllers/' . $url[0] . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            $this->error();
            return false;
        }

        $controller = new $url[0];
        $controller->loadModel($url[0]);

        if (isset($url[2])) {
            if (method_exists($controller, $url[1])) {
                $controller->{$url[1]}($url[2]);
            } else {
                $this->error();
            }
        } else {
            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    $controller->{$url[1]}();
                } else {
                    $this->error();
                }
            } else {
                $controller->index();
            }
        }
    }
	function error() {
		require 'controllers/error.php';
		$controller = new Error();
		$controller->index();
		return false;
	}

}