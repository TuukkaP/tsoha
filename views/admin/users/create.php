<div class="UserTable" >
<table>
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
    <tr>
    <form action="<?php echo URL . 'users/saveUser/'; ?>" method="POST">
        <td><input type = "text" name = "username" required="required"/></td>
        <td><input type = "text" name = "password" required="required"/></td>
        <td><input type = "text" name = "firstname"/></td>
        <td><input type = "text" name = "lastname"/></td>
        <td><input type = "text" name = "address"/></td>
        <td><input type = "text" name = "email"/></td>
        <td><select name="role" value="options">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </td>
        <td><input type="submit" value="Lisää" name="add"/></form></td>
</tr>
</table>
</div>