<?php
include ('lock.php');
?>

<table border = "1">
    <thead> 
        <tr>
            <th>Käyttäjänimi</th>
            <th>Etunimi</th>
            <th>Sukunimi</th>
            <th>Osoite</th>
            <th>Email</th>
            <th>Käyttöoikeus</th>
        </tr>
    </thead>
    <tbody>
        <tr><form action="update.php" method="POST"><input type = "hidden" name = "table" value = "users"/>
        <?php
        echo "\t<td><input type = \"text\" name = \"username\" value = \"" . $_POST['username'] . "\"/></td>\n";
        echo "\t<td><input type = \"text\" name = \"firstname\" value = \"" . $_POST['firstname'] . "\"/></td>";
        echo "\t<td><input type = \"text\" name = \"lastname\" value = \"" . $_POST['lastname'] . "\"/></td>";
        echo "\t<td><input type = \"text\" name = \"address\" value =\"" . $_POST['address'] . "\"/></td>";
        echo "\t<td><input type = \"text\" name = \"email\" value = \"" . $_POST['email'] . "\"/></td>";
        echo "\t<td><select name=\"role\" value=\"options\">
              \t\t  <option selected=\"selected\">" . $_POST['role'] . "</option>
              \t\t  <option value=\"admin\">Admin</option>
              \t\t <option value=\"user\">User</option>
            \t</select></td>";
        ?>
        <td> <input type="submit" value="Korjaa" name="korjaa"/><br>
        <input type="submit" value="Poista" name="poista"/></form></td>
</tr>
</tbody>
</table>

