<H1>Paikkojen lisääminen</h1>

<form method="post" action="<?php echo URL; ?>places/savePlace/">
    <label>Nimi: </label><input type="text" name="name" value=""/><br />
    <label>Osoite: </label><input type="text" name="address" value=""/><br />
    <label>Info: </label>&nbsp;<textarea name="info" cols="25" rows="5">
    </textarea><br>
    <label>&nbsp;</label><input type="submit" value="Lähetä" />
</form>