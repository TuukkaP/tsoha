<h1>Muokkaa paikan tietoja</h1>
<form method="post" action="<?php echo URL; ?>places/editSave/<?php echo $this->place['id']; ?>">
    <label>Nimi: </label><input type="text" name="name" value="<?php echo $this->place['name'] ?>"><br />
    <label>Osoite: </label><input type="text" name="address" value="<?php echo $this->place['address'] ?>"/><br />
    <label>Info: </label>&nbsp;<textarea name="info" cols="25" rows="5"><?php echo $this->place['info'] ?></textarea><br>
    <label>&nbsp;</label><input type="submit" value="Muokkaa" />
</form>