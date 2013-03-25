<?php

class Queries {

    private $_pdo;

    public function __construct($pdo) {
        $this->_pdo = $pdo;
    }

    public function login($username, $password) {
        $sql = $this->_pdo->prepare('SELECT username FROM users WHERE username = ? AND password = ?');
        if ($sql->execute(array($username, $password))) {
            return $sql->fetchObject();
        } else {
            return null;
        }
    }

    public function listAllAvailableOrders() {
        $sql = $this->_pdo->prepare('SELECT id,place,orders.date,start,stop FROM orders WHERE employee IS NULL ORDER BY date');
        return $sql->fetchObject();
    }
}

require dirname(__file__) . '/../dbconnect.php';
$queries = new Queries($pdo);

