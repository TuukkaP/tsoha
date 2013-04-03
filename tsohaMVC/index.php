<?php

require 'config.php';
include_once LIBS.'Bootstrap.php';
require_once LIBS.'Session.php';

// Also spl_autoload_register (Take a look at it if you like)
function __autoload($class) {
    if (file_exists(LIBS . strtolower($class) .".php") )
    {
      require LIBS . strtolower($class) .".php";
    }
	
}


$app = new Bootstrap();


?>