<?php

include_once LIBS . 'TreeCreator.php';
include_once LIBS . 'Controller.php';

class Orders extends Controller {

    function __construct() {
        parent::__construct();
        Lock::checkAdmin();
    }

    function index($place_id = "all", $inputDate = null, $user = "all") {
        Session::init();
        Session::set("date", $inputDate);
        $date = $this->model->getDate($inputDate);
        $tree = new TreeCreator();
        $tree->buildTree($this->model->getList($place_id, $date, $user));
        $this->view->begin = $date;
        $this->view->place_id = $place_id;
        $this->view->selectedUser = $user;
        $this->view->weekdayNames = $this->model->getWeekdays();
        $this->view->places = $this->model->getPlaces();
        $this->view->currentWeekSetList = $tree;
        $this->view->userList = $this->model->getUserList();
        $this->view->render('admin/orders/index');
    }

    function editOrder($id) {
        $this->view->order = $this->model->getOrder($id);
        $this->view->places = $this->model->getPlaces();
        $this->view->users = $this->model->getUsersForOrderId($id);
        $this->view->render('admin/orders/edit');
    }

    function addOrder($date = null, $place_id = null) {
        $this->view->place_id = $place_id;
        if ($date != null) {
            $dateTime = DateTime::createFromFormat('j.n.y', $date);
            $this->view->date = $dateTime->format('j.n.y');
            $this->view->users = $this->model->getUsersForOrderDate($dateTime);
        } else {
            if (isset($_SESSION["date"])) {
                $this->view->date = Session::get("date");
            } else {
            $this->view->date = $this->model->getDate(null)->format('j.n.y');
            }
            $this->view->users = $this->model->getUserList();
        }
        $this->view->places = $this->model->getPlaces();
        $this->view->render('admin/orders/create');
    }

    function saveOrder() {
        if (isset($_POST["submit"])) {
            $this->view->msg = $this->model->saveOrder();
        }
        $this->index("all", Session::get("date"), "all");
    }

    function updateOrder() {
        if (isset($_POST["submit"])) {
            $this->view->msg = $this->model->updateOrder();
        }
        $this->index("all", Session::get("date"), "all");
    }

    function deleteOrder($id) {
        $this->view->msg = $this->model->deleteOrder($id);
        $this->index();
    }

}