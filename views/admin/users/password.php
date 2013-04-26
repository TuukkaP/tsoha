<?php
if (isset($this->msg)) {
    echo $this->msg;
}
?>
<br>

<form method="post" action="<?php echo URL; ?>userInfo/passwordChange/<?php echo Session::get('id'); ?>">
    <label>Salasana: </label><input type="password" name="password"/><br />
    <label>Salasana uudestaan: </label><input type="password" name="passwordVerification"/><br />
    <label>&nbsp;</label><input type="submit" value="Lähetä" />
</form>