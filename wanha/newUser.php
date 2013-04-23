<?php
include ('lock.php');
if (isset($_POST['add'])) {
    $add = $queries->addUser(
            filter_var($_POST['username'], FILTER_SANITIZE_STRING), hash("sha256", filter_var($_POST['password'], FILTER_SANITIZE_STRING) . filter_var($_POST['username'], FILTER_SANITIZE_STRING)), filter_var($_POST['firstname'], FILTER_SANITIZE_STRING), filter_var($_POST['lastname'], FILTER_SANITIZE_STRING), filter_var($_POST['address'], FILTER_SANITIZE_STRING), filter_var($_POST['email'], FILTER_SANITIZE_EMAIL), filter_var($_POST['role'], FILTER_SANITIZE_STRING)
    );
    if ($add == true) {
        header("location: listUsers.php");
    } else {
        header("location: menu.php");
    }
}
?>

<table border = "1">
    <thead> 
        <tr>
            <th>Käyttäjänimi</th>
            <th>Salasana</th>
            <th>Etunimi</th>
            <th>Sukunimi</th>
            <th>Osoite</th>
            <th>Email</th>
            <th>Käyttöoikeus</th>
        </tr>
    </thead>
    <tbody>
        <tr><form action="" method="POST">
        <td><input type = "text" name = "username" value = ""/></td>
        <td><input type = "text" name = "password" value = ""/></td>
        <td><input type = "text" name = "firstname" value = ""/></td>
        <td><input type = "text" name = "lastname" value = ""/></td>
        <td><input type = "text" name = "address" value = ""/></td>
        <td><input type = "text" name = "email" value = ""/></td>
        <td><select name="role" value="options">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </td>
        <td><input type="submit" value="Lisää" name="add"/></form></td>
</tr>
</tbody>
</table>