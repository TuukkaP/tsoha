<?php

include_once LIBS . 'Controller.php';

class Users extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        if (Session::get('login') == false || Session::get('role') != 'admin') {
            header('location: ' . URL . 'main');
            exit;
        }
    }

    public function index() {
        $this->view->userList = $this->model->userList();
        $this->view->render('admin/users/index');
    }

    public function saveUser() {
        $data = array();
        $data['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $data['password'] = hash("sha256", filter_var($_POST['password'], FILTER_SANITIZE_STRING) . filter_var($_POST['username'], FILTER_SANITIZE_STRING));
        $data['firstname'] = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
        $data['lastname'] = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
        $data['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $data['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $data['role'] = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
        $operation = $this->model->create($data);
        if ($operation == true) {
            header("location: " . URL . "users/index/");
        } else {
            header("location: " . URL . "error/userNotCreated");
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
            header("location: " . URL . "error/userNotCreated");
        }
    }

    public function edit($id) {
        $this->view->user = $this->model->getUser($id);
        $this->view->render('admin/users/edit');
    }

    public function editSave($id) {
        $data = array();
        $data['id'] = $id;
        $data['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $data['firstname'] = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
        $data['lastname'] = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
        $data['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $data['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $data['role'] = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
        $operation = $this->model->editSave($data);
        if ($operation == true) {
            header("location: " . URL . "users/index/");
        } else {
            header("location: " . URL . "error/userNotCreated");
        }
    }

}