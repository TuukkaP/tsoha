
<div class="UserTable" >
    <?php if (isset($this->msg)) {
        echo $this->msg;
    } ?>
    <table>
        <thead> 
            <tr>
                <th>Nimi</th>
                <th>Osoite</th>
                <th>Info</th>
                <th>Korjaa</th>
                <th>Poista</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->placesList as $key => $value): ?>
                <tr>
                    <td> <?php echo $value['name']; ?></td>
                    <td> <?php echo $value['address']; ?></td>
                    <td> <?php echo $value['info']; ?></td>
                    <td> <a href="<?php echo URL . 'places/edit/' . $value['id']; ?>">Muokkaa</a></td>
                    <td> <a href="<?php echo URL . 'places/delete/' . $value['id']; ?>">Poista</a></td>
                </tr>
            <?php endforeach; ?>
    </table>
    <br/><a href="<?php echo URL . 'places/create/'; ?>">Lisää uusi paikka</a>
</div>