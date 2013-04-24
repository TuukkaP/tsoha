<?php

include_once LIBS . 'Controller.php';

class UserInfo extends Controller {

    function __construct() {
        parent::__construct();
        Lock::checkLogin();
    }

    public function index() {
        Session::init();
        $id = Session::get('id');
        $this->view->user = $this->model->getUser($id);
        $this->view->render('user/index');
    }

    public function edit($id) {
        $this->view->user = $this->model->getUser($id);
        $this->view->render('user/edit');
    }

    public function editSave($id) {
        if ($this->model->editSave($id)) {
            $this->index();
        } else {
            $this->msg = "Paikan poistaminen epäonnistui";
            $this->view->render("error/index");
        }
    }

    public function password() {
        $this->view->render('user/password');
    }

    public function passwordChange($id) {
        if ($_POST["password"] != $_POST["passwordVerification"]) {
            $this->view->msg = "Salasanat eivät täsmää!";
        } else {
            $this->view->msg = $this->model->changePassword($id, $_POST["password"]);
        }
        $this->view->render('user/password');
    }

}