<?php

require_once LIBS . 'Model.php';

class UserInfoModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUser($id) {
        $sql = $this->db->prepare('SELECT id,username,firstname,lastname,address,email,role FROM users WHERE id = ?');
        if ($sql->execute(array($id))) {
            return $sql->fetch();
        }
        return null;
    }

    public function editSave($data) {
        $sql = $this->db->prepare('UPDATE users SET firstname = ?,lastname = ?,address=?,email=? WHERE id = ?');
        if ($sql->execute(array($data['firstname'], $data['lastname'],
                    $data['address'], $data['email'], $data['id']))) {
            return true;
        }
        return false;
    }

}

