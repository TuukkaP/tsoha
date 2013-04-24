<?php

require_once LIBS . 'Model.php';

class UsersModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function userList() {
        $sql = $this->db->prepare("SELECT id, username, role, firstname, lastname, address, email FROM users ORDER BY lastname,firstname");
        if ($sql->execute()) {
            return $sql->fetchAll();
        }
        return null;
    }

    public function create() {
        $data = array();
        $data['username'] = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
        $data['password'] = hash("sha256", filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING) . $data["username"]);
        $data['firstname'] = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_STRING);
        $data['lastname'] = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING);
        $data['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $data['email'] = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $data['role'] = filter_var(trim($_POST['role']), FILTER_SANITIZE_STRING);
        $sql = $this->db->prepare('INSERT INTO users (username,password,firstname,lastname,address,email,role) 
            VALUES (?,?,?,?,?,?,?)');
        if ($sql->execute(array($data['username'], $data['password'], $data['firstname'], $data['lastname'],
                    $data['address'], $data['email'], $data['role']))) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $sql = $this->db->prepare('DELETE FROM users WHERE id = ?');
        if ($sql->execute(array(filter_var($id, FILTER_SANITIZE_NUMBER_INT)))) {
            return true;
        }
        return false;
    }

    public function getUser($id) {
        $sql = $this->db->prepare('SELECT id, username,firstname,lastname,address,email,role FROM users WHERE id = ?');
        if ($sql->execute(array(filter_var($id, FILTER_SANITIZE_NUMBER_INT)))) {
            return $sql->fetch();
        }
        return null;
    }

    public function editSave($id) {
        $data = array();
        $data['id'] = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $data['firstname'] = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
        $data['lastname'] = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
        $data['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $data['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $data['role'] = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
        $sql = $this->db->prepare('UPDATE users SET firstname = ?,lastname = ?,address=?,email=?,role=? WHERE id = ?');
        if ($sql->execute(array($data['firstname'], $data['lastname'],
                    $data['address'], $data['email'], $data['role'], $data['id']))) {
            return true;
        }
        return false;
    }

}

