<!DOCTYPE html>
<?php
include("dbconnect.php");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login</title>
    </head>
    <body>
        <h1>Welcome :: Login</h1>
        <form action="login.php" method="post">
            <label>UserName :</label>
            <input type="text" name="username"/><br />
            <label>Password :</label>
            <input type="password" name="password"/><br/>
            <input type="submit" value=" Submit "/><br />
        </form>
    </body>
</html>
