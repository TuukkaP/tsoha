<?php

include_once LIBS . 'Controller.php';

class Orders extends Controller {

    function __construct() {
        parent::__construct();
        Lock::checkAdmin();
    }

    function index($inputDate = null, $user = "all") {
        $date = $this->model->getDate($inputDate);
        $this->view->begin = $date;
        $this->view->selectedUser = $user;
        $this->view->weekdayNames = $this->model->getWeekdays();
        $list = $this->model->currentWeekSetList($date, $user);
        $this->view->currentWeekSetList = (new TreeCreator())->buildTree($list);
        $this->view->render('orders/index');
    }

    function userOrders($inputDate = null, $user = "all") {
        $date = $this->model->getDate($inputDate);
        $this->view->begin = $date;
        $this->view->selectedUser = $user;
        $this->view->weekdayNames = $this->model->getWeekdays();
        $list = $this->model->currentWeekSetList($date);
        $this->view->currentWeekSetList = (new TreeCreator())->buildTree($list);
        $this->view->render('orders/index');
    }

}