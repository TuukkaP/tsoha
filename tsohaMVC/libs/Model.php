<?php

require_once LIBS.'Database.php';
//require_once LIBS.'Session.php';
class Model {

    public function __construct() {
        $this->db = new Database();
    }

}


