<?php

include_once LIBS . 'Controller.php';

class Error extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->view->msg = 'Jotain meni vituiks.';
        $this->view->render('error/index');
    }

    function userNotCreated() {
        $this->view->msg = "Käyttäjän luominen epäonnistui!";
        $this->view->render('error/index');
    }
    
    
    function userPasswordsDontMatch() {
        $this->view->msg = "Jos haluat muuttaa salasanaa, anna sama salasana kahteen kenttään!";
        $this->view->render('error/index');
    }
}