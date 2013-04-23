<?php
include_once LIBS.'Controller.php';
class Index extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->view->render('index/index');
    }

    function secret() {
        $this->view->msg = 'Secretsssssss';
        $this->view->render('index/secret');
    }

}
