<?php
require_once 'tools/session.php';
unset($session->username);
header("Location: index.php");
?>