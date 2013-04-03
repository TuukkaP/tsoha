<h1>Muokkaa käyttäjän tietoja</h1>
<div class="UserTable" >
<table>
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
    <tr>
    <form action="<?php echo URL . 'users/editSave/'.$this->user['id'] ; ?>" method="POST">
        <td><input type = "text" name = "username" required="required" value="<?php echo $this->user['username'] ?>"/></td>
        <td><input type = "text" name = "firstname" value="<?php echo $this->user['firstname'] ?>"/></td>
        <td><input type = "text" name = "lastname" value="<?php echo $this->user['lastname'] ?>"/></td>
        <td><input type = "text" name = "address" value="<?php echo $this->user['address'] ?>"/></td>
        <td><input type = "text" name = "email" value="<?php echo $this->user['email'] ?>"/></td>
        <td><select name="role" value="options">
                <option value="admin" <?php if($this->user['role'] == 'admin') echo 'selected'; ?> >Admin</option>
                <option value="user" <?php if($this->user['role'] == 'user') echo 'selected'; ?> >User</option>
            </select>
        </td>
        <td><input type="submit" value="Muokkaa" name="edit"/></form></td>
</tr>
</table>
</div>