<?php

class Queries {

    private $_pdo;

    public function __construct($pdo) {
        $this->_pdo = $pdo;
    }

    public function login($username, $password) {
        $hashedpassword = hash("sha256", $password.$username);
        $sql = $this->_pdo->prepare('SELECT username,role FROM users WHERE username = ? AND password = ?');
        if ($sql->execute(array($username, $hashedpassword))) {
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

    public function addUser($username, $password, $firstname, $lastname, $address, $email, $role) {
        $sql = $this->_pdo->prepare('INSERT INTO users (username,password,firstname,lastname,address,email,role) VALUES (?,?,?,?,?,?,?)');
        if ($sql->execute(array($username, $password, $firstname, $lastname, $address, $email, $role))) {
            return true;
        }
        return false;
    }

    public function getUser($username) {
        $sql = $this->_pdo->prepare('SELECT username,firstname,lastname,address,email FROM users WHERE username = ?');
        if ($sql->execute(array($username))) {
            return $sql->fetchObject();
        }
        return null;
    }

    public function deleteUser($username) {
        $sql = $this->_pdo->prepare('DELETE FROM users WHERE username = ?');
        if ($sql->execute(array($username))) {
            return true;
        }
        return false;
    }

    public function updateUser($username, $firstname, $lastname, $address, $email, $role) {
        $sql = $this->_pdo->prepare('UPDATE users SET username = ?,firstname = ?,lastname = ?,address=?,email=?,role=? WHERE username = ?');
        if ($sql->execute(array($username, $firstname, $lastname, $address, $email, $role, $username))) {
            return true;
        } else {
            return false;
        }
    }

}

require dirname(__file__) . '/../dbconnect.php';
$queries = new Queries($pdo);

