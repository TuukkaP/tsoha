<h1>Salasanan resetointi</h1>
<?php
if (isset($this->msg)) {
    echo "<br>".$this->msg."<br>";
}
?>
<form action="<?php echo URL ?>passwordReset/reset" method="post">
	<label>Anna sähköposti</label><input type="email" name="email" /><br />
        <label>Anna sähköposti uudestaan</label><input type="email" name="email2" /><br />
	<label></label><input type="submit" />
</form>