<?php
include ('lock.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Company ab - Workscheduling</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <p style="text-align:right;">
            <?php  
            echo date('l, F jS, Y');
            echo $session->username;           
            ?>
            <a href="logout.php">Logout</a>;
        </p>        
    </body>    
</html>

