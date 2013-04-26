
<div class="UserTable" >
    <?php
    if (isset($this->msg)) {
        echo $this->msg;
    }
    ?>
    <table>
        <thead> 
            <tr>
                <th>Käyttäjänimi</th>
                <th>Etunimi</th>
                <th>Sukunimi</th>
                <th>Osoite</th>
                <th>Email</th>
                <th>Käyttöoikeus</th>
                <th>Korjaa</th>
                <th>Poista</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($this->userList as $key => $value): ?>
                <tr>
                    <td> <?php echo $value['username']; ?></td>
                    <td> <?php echo $value['firstname']; ?></td>
                    <td> <?php echo $value['lastname']; ?></td>
                    <td> <?php echo $value['address']; ?></td>
                    <td> <?php echo $value['email']; ?></td>
                    <td> <?php echo $value['role']; ?></td>
                    <td> <a href="<?php echo URL . 'users/edit/' . $value['id']; ?>">Muokkaa</a></td>
                    <td> <a href="<?php echo URL . 'users/delete/' . $value['id']; ?>">Poista</a></td>
                </tr>
<?php endforeach; ?>
    </table>
    <br/>
    <a href="<?php echo URL . 'users/create/'; ?>">Lisää uusi käyttäjä</a>
    <br/><br/>
    <a href="<?php echo URL . 'users/password/'; ?>">Vaihda salasana</a>
</div>