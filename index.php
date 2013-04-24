<?php

require 'config.php';
require_once LIBS.'FrontController.php';
require_once LIBS.'Session.php';
require 'tools/lock.php';

function __autoload($class) {
    if (file_exists(LIBS . strtolower($class) .".php") )
    {
      require LIBS . strtolower($class) .".php";
    }
	
}


$app = new FrontController();
$app->run();


?>