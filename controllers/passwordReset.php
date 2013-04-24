<?php

include_once LIBS . 'Controller.php';

class PasswordReset extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->view->render('passwordReset/index');
    }

    function reset() {
        if ($_POST["email"] == $_POST["email2"]) {
            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $this->view->msg = $this->model->resetPassword(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
            } else {
                $this->view->msg = "Antamasi email ei ollut oikeaa muotoa.";
            }
        } else {
            $this->view->msg = "Anna email!";
        }
        $this->view->render('passwordReset/index');
    }

}