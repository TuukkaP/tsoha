<?php

require 'config.php';
require_once LIBS.'FrontController.php';
require_once LIBS.'Session.php';
require 'tools/lock.php';

// Also spl_autoload_register (Take a look at it if you like)
function __autoload($class) {
    if (file_exists(LIBS . strtolower($class) .".php") )
    {
      require LIBS . strtolower($class) .".php";
    }
	
}


$app = new FrontController();
$app->run();


?>