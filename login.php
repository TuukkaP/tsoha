<?php

require_once 'tools/queries.php';
require_once 'tools/session.php';
$user = $queries->login(filter_var($_POST['username'],FILTER_SANITIZE_STRING), filter_var($_POST['password'],FILTER_SANITIZE_STRING));
if ($user) {
    $session->setSession('username', $user->username, 'role', $user->role);
    header("location: menu.php");
} else {
    header("location: index.php");
}
?>
