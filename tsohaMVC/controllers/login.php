<?php

include_once LIBS . 'Controller.php';

class Login extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        Session::init();
        $logged = Session::get('login');
        if ($logged == false) {
            $this->view->render('login/index');
        } else {
            $this->view->msg = 'Olet jo kirjautunut sisään!';
            $this->view->render('main/msg');
        }
    }

    function login() {
        Session::init();
        $logged = Session::get('login');
        if ($logged == false) {
            $this->model->doLogin();
        } else {
            $this->view->msg = 'Olet jo kirjautunut sisään! ' . $session->username;
            $this->view->render('main/msg');
        }
    }

    function wrong() {
        $this->view->render('login/loginerror');
    }

}

