<?php

include ('lock.php');
if (filter_var($_POST['table'], FILTER_SANITIZE_STRING) === 'users') {
    if ($_POST['korjaa']) {
        $update = $queries->updateUser(
                filter_var($_POST['username'], FILTER_SANITIZE_STRING),
                filter_var($_POST['firstname'], FILTER_SANITIZE_STRING),
                filter_var($_POST['lastname'], FILTER_SANITIZE_STRING),
                filter_var($_POST['address'], FILTER_SANITIZE_STRING),
                filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                filter_var($_POST['role'], FILTER_SANITIZE_STRING),
                filter_var($_POST['username'], FILTER_SANITIZE_STRING)
                );
    } else if ($_POST['poista']) {
        $update = $queries->deleteUser(filter_var($_POST['username']));
    }
}

if ($update == true && $_POST['table'] === 'users') {
    header("location: listUsers.php");
} else {
    header("location: menu.php?404");
}
?>