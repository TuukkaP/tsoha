<?php

class Session {

  public function __construct() {
    session_start();
  }

  public function __set($key, $user) {
    $_SESSION[$key] = $user;
  }

  public function __get($user) {
    if ($this->__isset($user)) {
      return $_SESSION[$user];
    }
    return null;
  }

  public function __isset($user) {
    return isset($_SESSION[$user]);
  }

  public function __unset($user) {
    unset($_SESSION[$user]);
  }

}

$session = new Session();
?>