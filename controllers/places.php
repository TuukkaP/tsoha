<?php

include_once LIBS . 'Controller.php';

class Places extends Controller {

    function __construct() {
        parent::__construct();
        Lock::checkAdmin();
    }

    public function index() {
        $this->view->placesList = $this->model->placesList();
        $this->view->render('places/index');
    }

    public function savePlace() {
        $data = array();
        $data['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $data['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $data['info'] = filter_var($_POST['info'], FILTER_SANITIZE_STRING);
        $operation = $this->model->create($data);
        if ($operation == true) {
            header("location: " . URL . "places/index/");
        } else {
            header("location: " . URL . "error/userNotCreated");
        }
    }

    public function create() {
        $this->view->render('places/create');
    }

    public function delete($id) {
        $operation = $this->model->delete($id);
        if ($operation == true) {
            header("location: " . URL . "places/index/");
        } else {
            header("location: " . URL . "error/userNotCreated");
        }
    }

    public function edit($id) {
        $this->view->place = $this->model->getPlace($id);
        $this->view->render('places/edit');
    }

    public function editSave($id) {
        $data = array();
        $data['id'] = $id;
        $data['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $data['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $data['info'] = filter_var($_POST['info'], FILTER_SANITIZE_STRING);
        $operation = $this->model->editSave($data);
        if ($operation == true) {
            header("location: " . URL . "places/index/");
        } else {
            header("location: " . URL . "error/userNotCreated");
        }
    }
    
}