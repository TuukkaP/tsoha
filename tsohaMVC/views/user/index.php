
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
                <th>Korjaa</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td> <?php echo $this->user['username']; ?></td>
                    <td> <?php echo $this->user['firstname']; ?></td>
                    <td> <?php echo $this->user['lastname']; ?></td>
                    <td> <?php echo $this->user['address']; ?></td>
                    <td> <?php echo $this->user['email']; ?></td>
                    <td> <?php echo $this->user['role']; ?></td>
                    <td> <a href="<?php echo URL . 'userInfo/edit/' . $this->user['id']; ?>">Muokkaa</a></td>
                </tr>
    </table>
</div>