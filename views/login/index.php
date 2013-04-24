<h1>Login</h1>
<?php
if (isset($this->msg)) {
    echo "<br>".$this->msg."<br>";
}

?>
<form action="<?php echo URL ?>login/login" method="post">
	<label>Login</label><input type="text" name="username" /><br />
	<label>Password</label><input type="password" name="password" /><br />
	<label></label><input type="submit" />
</form>