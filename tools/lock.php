<?php

class Lock {

    public static function checkLogin() {
        @session_start();
        $login = $_SESSION['login'];
        if ($login == false) {
            session_destroy();
            header("location: ".URL."login/");
            exit;
        }
    }

    public static function checkAdmin() {
        @session_start();
        $login = $_SESSION['login'];
        $admin = $_SESSION['role'];
        if ($login == true && $admin === 'admin') {
            return true;
        }
        header("location: ".URL."main/");
    }

}

