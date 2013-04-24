<?php

include_once LIBS . 'Controller.php';

class Users extends Controller {

    function __construct() {
        parent::__construct();
        Lock::checkAdmin();
    }

    public function index() {
        $this->view->userList = $this->model->userList();
        $this->view->render('admin/users/index');
    }

    public function saveUser() {
        $operation = $this->model->create();
        if ($operation == true) {
            header("location: " . URL . "users/index/");
        } else {
            $this->msg = "Paikan poistaminen epäonnistui";
            $this->view->render("error/index");
        }
    }

    public function create() {
        $this->view->render('admin/users/create');
    }

    public function delete($id) {
        $operation = $this->model->delete($id);
        if ($operation == true) {
            header("location: " . URL . "users/index/");
        } else {
            $this->msg = "Paikan poistaminen epäonnistui";
            $this->view->render("error/index");
        }
    }

    public function edit($id) {
        $this->view->user = $this->model->getUser($id);
        $this->view->render('admin/users/edit');
    }

    public function editSave($id) {
        $operation = $this->model->editSave($id);
        if ($operation == true) {
            header("location: " . URL . "users/index/");
        } else {
            $this->msg = "Paikan poistaminen epäonnistui";
            $this->view->render("error/index");
        }
    }

}