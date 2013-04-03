<?php

//class Session {
//
//  public function __construct() {
//      session_start();
//  }
//
//    public function setSession($key, $user, $key2, $role) {
//        $_SESSION[$key] = $user;
//        $_SESSION[$key2] = $role;
//    }
//
//    public function __get($user) {
//        if ($this->__isset($user)) {
//            return $_SESSION[$user];
//        }
//        return null;
//    }
//    
//    public function getRole() {
//        if ($this->__isset('role')) {
//            return $_SESSION['role'];
//        }
//        return null;
//    }
//
//  public function __isset($user) {
//    return isset($_SESSION[$user]);
//  }
//
//  public function __unset($user) {
//    unset($_SESSION[$user]);
//  }
//  
//  public function getSession() {
//      return $this;
//  }
//
//}
//
//            $session = new Session();
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

