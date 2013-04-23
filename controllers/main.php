<?php

include_once LIBS . 'Controller.php';

class Main extends Controller {

    function __construct() {
        parent::__construct();
        Lock::checkLogin();
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