<?php

require_once LIBS . 'Model.php';

class UsersModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function userList() {
        $sql = $this->db->prepare("SELECT id, username, role, firstname, lastname, address, email FROM users");
        if ($sql->execute()) {
            return $sql->fetchAll();
        }
        return null;
    }

    public function create($data) {
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
        if ($sql->execute(array($id))) {
            return true;
        }
        return false;
    }

    public function getUser($id) {
        $sql = $this->db->prepare('SELECT id, username,firstname,lastname,address,email,role FROM users WHERE id = ?');
        if ($sql->execute(array($id))) {
            return $sql->fetch();
        }
        return null;
    }
    
        public function editSave($data) {
        $sql = $this->db->prepare('UPDATE users SET username = ?,firstname = ?,lastname = ?,address=?,email=?,role=? WHERE id = ?');
        if ($sql->execute(array($data['username'], $data['firstname'], $data['lastname'],
                    $data['address'], $data['email'], $data['role'], $data['id'] ))) {
            return true;
        }
        return false;
    }

}

