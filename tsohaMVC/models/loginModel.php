<?php

require_once LIBS . 'Model.php';

class LoginModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function doLogin() {
        $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
        $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
        $hashedpassword = hash("sha256", $password . $username);
        $sql = $this->db->prepare("SELECT id,username,role FROM users WHERE username = ? AND password = ?");
        if ($sql->execute(array($username, $hashedpassword))) {
            $data = $sql->fetch();
            $count = $sql->rowCount();
        } else {
            exit;
        }

        if ($count == 1) {
            Session::init();
            Session::set('id', $data['id']);
            Session::set('role', $data['role']);
            Session::set('username', $data['username']);
            Session::set('login', true);
//            session_start();
//            $_SESSION('username') = $data['username'];
//            $_SESSION('role') = $data['role'];
            header("location: ../main/index");
        } else {
            header("location: ../login/wrong");
        }
    }

}
