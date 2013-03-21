<?php

require_once 'tools/queries.php';
require_once 'tools/session.php';

    if (!isset($session->username)) {
        header("Location: index.php");
    }
?>

