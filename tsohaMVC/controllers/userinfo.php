<?php

include_once LIBS . 'Controller.php';

class UserInfo extends Controller {
    
    function __construct() {
        parent::__construct();
        Session::init();
        if (Session::get('login') == false) {
            echo 'BÄÄÄÄÄÄÄ';
            header('location: ' . URL . 'login');
            exit;
        }
    }

    public function index() {
        $id = Session::get('id');
        $this->view->user = $this->model->getUser($id);
        $this->view->render('user/index');
    }
    
        public function edit($id) {
        $this->view->user = $this->model->getUser($id);
        $this->view->render('user/edit');
    }

    public function editSave($id) {
        $data = array();
        $data['id'] = $id;
        $data['firstname'] = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
        $data['lastname'] = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
        $data['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $data['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $operation = $this->model->editSave($data);
        if ($operation == true) {
            header("location: " . URL . "userInfo/index/");
        } else {
            header("location: " . URL . "error/userNotCreated");
        }
    }
}