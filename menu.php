<?php
include ('lock.php');
require 'tools/top.php';
?>

<!DOCTYPE html>
<html>

    <body>
        <h1>Welcome <?php echo $session->username; ?></h1><br>
        
        Olet <?php echo $session->getRole(); ?>!!! <br>
        <a href="listUsers.php">List users</a>
        <a href="logout.php">Logout</a>
        <a href="top.php">top</a>

        <h1>Ominaisuuksia to be built</h1>

        <ul>
            <li>Listaa vapaat työvuorot</li>
            <li>Listaa omat työvuorot</li>
            <li>ADMIN: Lisää työvuoro</li>
            <li>ADMIN: Poista työvuoro</li>
        </ul>
    </body>
</html>
