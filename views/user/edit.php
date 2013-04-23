<form method="post" action="<?php echo URL; ?>userInfo/editSave/<?php echo Session::get('id'); ?>">
    <input type="hidden" name="text" value="<?php echo $this->user['username']; ?>" /><br/>
    <label>&nbsp;</label>Käyttäjänimi: <?php echo $this->user['username']; ?><br />
    <label>Etunimi: </label><input type="text" name="firstname" value="<?php echo $this->user['firstname']; ?>"/><br />
    <label>Sukunimi: </label><input type="text" name="lastname" value="<?php echo $this->user['lastname']; ?>"/><br />
    <label>Osoite: </label><input type="text" name="address" value="<?php echo $this->user['address']; ?>"/><br />
    <label>Email: </label><input type="text" name="email" value="<?php echo $this->user['email']; ?>"/><br />
    <label>&nbsp;</label><input type="submit" value="Lähetä" />
</form>
<br>
<br>
<a href="<?php echo URL; ?>userInfo/password/">Vaihda salasanaa</a>



