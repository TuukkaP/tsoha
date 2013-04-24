<?php

require_once LIBS . 'Model.php';

class UserInfoModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUser($id) {
        $sql = $this->db->prepare('SELECT id,username,firstname,lastname,address,email,role FROM users WHERE id = ?');
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
        $sql = $this->db->prepare('UPDATE users SET firstname = ?,lastname = ?,address=?,email=? WHERE id = ?');
        if ($sql->execute(array($data['firstname'], $data['lastname'],
                    $data['address'], $data['email'], $data['id']))) {
            return true;
        }
        return false;
    }

    public function changePassword($id, $password) {
        $hashedPassword = hash("sha256", filter_var($password, FILTER_SANITIZE_STRING) . Session::get("username"));
        $sql = $this->db->prepare('UPDATE users SET password = ? WHERE id = ?');
        if ($sql->execute(array($hashedPassword, filter_var($id, FILTER_SANITIZE_NUMBER_INT)))) {
            return "Salasanan vaihto onnistui!";
        }
        return "Salasanan vaihto epäonnistui!";
    }

}

