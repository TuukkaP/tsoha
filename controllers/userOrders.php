<?php

include_once LIBS . 'TreeCreator.php';
include_once LIBS . 'Controller.php';

class userOrders extends Controller {

    function __construct() {
        parent::__construct();
        Lock::checkLogin();
    }

    function index($inputDate = null) {
        $date = $this->model->getDate($inputDate);
        $tree = (new TreeCreator())->buildTree($this->model->getList($place_id = "all", $date, Session::get("id")));
        $this->view->begin = $date;
        $this->view->place_id = $place_id;
        $this->view->weekdayNames = $this->model->getWeekdays();
        $this->view->places = $this->model->getPlaces();
        $this->view->currentWeekSetList = $tree;
        $this->view->render('orders/index');
    }

}

