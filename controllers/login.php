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
            $this->view->render('main/index');
        }
    }

    function login() {
        Session::init();
        $logged = Session::get('login');
        if ($logged == false) {
            if ($this->model->doLogin()) {
                $this->view->render('main/index');
            } else {
                $this->view->msg = "Sisäänkirjautuminen epäonnistui!";
                $this->view->render('login/index');
            }
        } else {
            $this->view->msg = 'Olet jo kirjautunut sisään! ' . Session::get('username');
            $this->view->render('main/index');
        }
    }

}

