<?php

include_once LIBS . 'Controller.php';

class Main extends Controller {

    function __construct() {
        parent::__construct();
//        if (!isset($_SESSION('username'))) {
//            header('location: ../login');
//            exit;
//        }
        Session::init();
        $logged = Session::get('login');
        if ($logged == false) {
            Session::destroy();
            header('location: ../login');
            exit;
        }
    }

    function index() {
        $this->view->render('main/index');
    }

    function msg($msg) {
        $this->view->msg = $msg;
        $this->view->render('main/main');
    }

    function logout() {
        Session::init();
        $logged = Session::get('login');
        if ($logged == true) {
            Session::destroy();
            $this->view->msg = 'Kirjauduit ulos!';
            $this->view->render('index/secret');
            exit;
        }
    }

}