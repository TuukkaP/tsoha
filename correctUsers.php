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
        echo '<td><input type = "text" name = "username" value = "' . $_POST['username'] . '"/></td>';
        echo '<td><input type = "text" name = "firstname" value = "' . $_POST['firstname'] . '"/></td>';
        echo '<td><input type = "text" name = "lastname" value = "' . $_POST['lastname'] . '"/></td>';
        echo '<td><input type = "text" name = "address" value = "' . $_POST['address'] . '"/></td>';
        echo '<td><input type = "text" name = "email" value = "' . $_POST['email'] . '"/></td>';
        echo '<td><input type = "text" name = "role" value = "' . $_POST['role'] . '"/></td>';
        ?>
        <td> <input type="submit" value="Korjaa" name="korjaa"/><br>
        <input type="submit" value="Poista" name="poista"/></form></td>
</tr>
</tbody>
</table>

