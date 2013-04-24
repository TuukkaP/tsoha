<?php

include_once LIBS . 'Controller.php';

class Places extends Controller {

    function __construct() {
        parent::__construct();
        Lock::checkAdmin();
    }

    public function index() {
        $this->view->placesList = $this->model->placesList();
        $this->view->render('admin/places/index');
    }

    public function savePlace() {
        if ($this->model->create()) {
            header("location: " . URL . "places/index/");
        } else {
            $this->msg = "Paikan poistaminen epäonnistui";
            $this->view->render("error/index");
        }
    }

    public function create() {
        $this->view->render('admin/places/create');
    }

    public function delete($id) {
        if ($this->model->delete($id)) {
            header("location: " . URL . "places/index/");
        } else {
            $this->msg = "Paikan poistaminen epäonnistui";
            $this->view->render("error/index");
        }
    }

    public function edit($id) {
        $this->view->place = $this->model->getPlace($id);
        $this->view->render('admin/places/edit');
    }

    public function editSave($id) {
        if ($this->model->editSave($id)) {
            header("location: " . URL . "places/index/");
        } else {
            $this->msg = "Paikan muokkaus epäonnistui";
            $this->view->render("error/index");
        }
    }

}