<!--<pre>-->    
    <?php
//    print_r($this->order);
//    print_r($this->users);
//    print_r($this->places);
    $date = new DateTime($this->order["date"]);
    $date->modify("-2 week");
    $origDate = new DateTime($this->order["date"]);
    $startTimes = explode(":", $this->order["order_start"]);
    $endTimes = explode(":", $this->order["order_end"]);
//    print_r($startTimes);
//    print_r($endTimes);
    ?>
<div class="OrderTable" >
    <h1>Vuoron muokkaus</h1>
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
        <form action="<?php echo URL . 'orders/updateOrder'; ?>" method="POST">
            <input type="hidden" name="order_id" value="<?php echo $this->order["order_id"]; ?>">
            <td>
                <select name="date" value="options">
                        <?php
                        for ($i = 0; $i < 42; $i++) {
                            echo "<option value=\"" . $date->format('j.n.y') . "\"";
                            if ($date == $origDate) {
                                echo " selected ";
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
                            if ($this->order["place_id"] == $place["id"]) {
                                echo " selected ";
                            }
                            echo ">" . $place["name"] . "</option>";
                        }
                        ?>
                </select></td>
            <td><select name="start_hour" value="options">
                        <?php
                        for ($i = 7; $i < 23; $i++) {
                            echo "<option value=\"" . $i . "\"";
                            if ($startTimes[0] == $i) {
                                echo " selected ";
                            }
                            echo ">" . $i . "</option>";
                        }
                        ?>
                </select>
                <select name="start_min" value="options">
                        <?php
                        for ($i = 0; $i < 46; $i += 15) {
                            echo "<option value=\"" . $i . "\"";
                            if ($startTimes[1] == $i) {
                                echo " selected ";
                            }
                            echo ">" . $i . "</option>";
                        }
                        ?>
                </select>
            </td>
            <td><select name="end_hour" value="options">
                        <?php
                        for ($i = 7; $i < 23; $i++) {
                            echo "<option value=\"" . $i . "\"";
                            if ($endTimes[0] == $i) {
                                echo " selected ";
                            }
                            echo ">" . $i . "</option>";
                        }
                        ?>
                </select>
                <select name="end_min" value="options">
                        <?php
                        for ($i = 0; $i < 46; $i += 15) {
                            echo "<option value=\"" . $i . "\"";
                            if ($endTimes[1] == $i) {
                                echo " selected ";
                            }
                            echo ">" . $i . "</option>";
                        }
                        ?>
                </select></td>
            <td>
                <select name="user_id" value="options">
                    <option value="none">Ei tekijää</option>
                        <?php
                        foreach ($this->users as $user) {
                            echo "<option value=\"" . $user["id"] . "\"";
                            if ($this->order["user_id"] == $user["id"]) {
                                echo "selected";
                            }
                            echo ">" . $user["name"];
                            if ($user["place_name"] != null || $user["time"] != null) {
                                echo "   (" . $user["place_name"] . ", " . $user["time"] . ")";
                            }
                            echo "</option>";
                        }
                        ?>
                </select>
            </td>
            <td><input type="submit" value="Muokkaa" name="submit"/></form></td>
        </tr>
    </table>
    <br><br>
    <a href="<?php echo URL."orders/deleteOrder/".$this->order["order_id"]; ?>">Poista vuoro</a>
    
</div>