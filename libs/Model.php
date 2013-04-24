<?php

require_once LIBS.'Database.php';
class Model {

    public function __construct() {
        $this->db = new Database();
    }

}


