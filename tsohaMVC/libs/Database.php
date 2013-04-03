<?php

class Database extends PDO {

    function __construct() {
        try {
//        parent::__construct("pgsql:host=localhost; dbname=peuranie", "peuranie", "caa0b83bc9393e6e");
            parent::__construct("mysql:host=127.0.0.1; dbname=peuranie", "root", "");
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
    }

}

