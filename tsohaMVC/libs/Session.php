<?php

class Session {

    public static function init() {
//        if (session_status() != 2) {
            @session_start();
//        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    public static function destroy() {
        $_SESSION['login'] = false;
    }

}

