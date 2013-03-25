<?php

class Queries {

    private $_pdo;

    public function __construct($pdo) {
        $this->_pdo = $pdo;
    }

    public function login($username, $password) {
        $sql = $this->_pdo->prepare('SELECT username,role FROM users WHERE username = ? AND password = ?');
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

    public function listAllUsers() {
        $sql = $this->_pdo->prepare('SELECT * FROM users');
        if ($sql->execute()) {
            $datas = array();
            while ($data = $sql->fetchObject()) {
                $datas[] = $data;
            }
            return $datas;
        }
        return null;
    }

    public function updateUsers($username, $firstname, $lastname, $address, $email) {
        $sql = $this->_pdo->prepare('UPDATE users SET username = ?,firstname = ?,lastname = ?,address=?,email=? WHERE username = ?');
        if ($sql->execute(array($username, $firstname, $lastname, $address, $email, $username))) {
            return $sql->fetchObject();
        } else {
            return null;
        }
    }

}

require dirname(__file__) . '/../dbconnect.php';
$queries = new Queries($pdo);

