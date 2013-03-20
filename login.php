<?php

require_once 'tools/queries.php';
require_once 'tools/session.php';
$user = $queries->login($_POST['username'], $_POST['password']);
if ($user) {
    $session->username = $user->username;
    header("location: menu.php");
} else {
    header("location: index.php");
}
?>
