<?php
include ('lock.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Welcome <?php echo $session->username; ?></h1>
        <a href="logout.php">Logout</a>
    </body>
</html>
