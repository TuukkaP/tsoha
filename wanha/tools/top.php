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
            echo date('D, d-m-Y'), '<br>';
            echo $session->username, '<br>';           
            ?>
            <a href="logout.php">Logout</a>;
        </p>        
    <div id="navcontainer">
            <ul id="navlist"> 
                <li id="active"><a href="#" id="current">Item one</a></li>
                <li><a href="#">pylly</a></li>
                <li><a href="#">Item three</a></li>
                <li><a href="#">pissa</a></li>
                <li><a href="#">kakka</a></li>
            </ul>
        </div>

</body>    
</html>

