<?php
include ('lock.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Company ab - Workscheduling</title>
    </head>
    <body>
        <h1>Welcome <?php echo $session->username; ?></h1>
        <a href="logout.php">Logout</a>

        <h1>Ominaisuuksia to be built</h1>

        <ul>
            <li>Listaa vapaat työvuorot</li>
            <li>Listaa omat työvuorot</li>
            <li>ADMIN: Lisää työvuoro</li>
            <li>ADMIN: Poista työvuoro</li>
        </ul>
    </body>
</html>
