<?php
$date = DateTime::createFromFormat('j.n.y', $this->date)->modify("-2 week");
$origDate = DateTime::createFromFormat('j.n.y', $this->date);
?>
<div class="OrderTable" >
    <h1>Vuoron lisäys</h1>
    Päivämäärä ulottuu kuukauden verran eteenpäin. Jos haluat lisätä vuoron jo seuraavalle 4 viikon jaksolle valitse seuraava viikkolistaus.
    <table>
        <thead> 
            <tr>
                <th>Päivämäärä</th>
                <th>Paikka</th>
                <th>Vuoro alkaa</th>
                <th>Vuoro loppuu</th>
                <th>Tekijä</th>
            </tr>
        </thead>
        <tr>
        <form action="<?php echo URL . 'orders/saveOrder'; ?>" method="POST">
            <td>
                <select name="date" value="options">
                    <?php
                    for ($i = 0; $i < 42; $i++) {
                        echo "<option value=\"" . $date->format('j.n.y') . "\"";
                        if ($date == $origDate) {
                            echo "selected";
                        }
                        echo ">" . $date->format('j.n.y') . "</option>";
                        $date->modify("+1 day");
                    }
                    ?>
                </select>
            </td>
            <td><select name="place_id" value="options">
                    <?php
                    foreach ($this->places as $place) {
                        echo "<option value=\"" . $place["id"] . "\"";
                        if ($this->place_id == $place["id"]) {
                            echo "selected";
                        }
                        echo ">" . $place["name"] . "</option>";
                    }
                    ?>
                </select></td>
            <td><select name="start_hour" value="options">
                    <?php
                    for ($i = 7; $i < 23; $i++) {
                        echo "<option value=\"" . $i . "\">" . $i . "</option>";
                    }
                    ?>
                </select>
                <select name="start_min" value="options">
                    <?php
                    for ($i = 0; $i < 46; $i += 15) {
                        echo "<option value=\"" . $i . "\">" . $i . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td><select name="end_hour" value="options">
                    <?php
                    for ($i = 7; $i < 23; $i++) {
                        echo "<option value=\"" . $i . "\">" . $i . "</option>";
                    }
                    ?>
                </select>
                <select name="end_min" value="options">
                    <?php
                    for ($i = 0; $i < 46; $i += 15) {
                        echo "<option value=\"" . $i . "\">" . $i . "</option>";
                    }
                    ?>
                </select></td>
            <td>
                <select name="user_id" value="options">
                    <option value="none">Ei tekijää</option>
                    <?php
                    foreach ($this->users as $user) {
                        echo "<option value=\"" . $user["id"] . "\"";
                        echo ">" . $user["name"] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td><input type="submit" value="Lisää" name="submit"/></form></td>
        </tr>
    </table>
</div>
