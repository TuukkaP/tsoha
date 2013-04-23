<?php
include 'ordersMenu.php';
if (isset($this->msg)) {
    echo $this->msg;
}
?>
<div class="OrdersTable" >
    <!--Format 1.4.13-->
    <!--<pre>-->
        <?php
//        print_r($this->currentWeekSetList);
        $weekday = $this->begin;
//    $weekday = new DateTime('2013-01-01');
        for ($i = 0; $i < 4; $i++):
            ?>
            <table>
                <thead> 
                    <tr>
                        <th>Paikka</th>
                        <?php
                        for ($j = 0; $j < 7; $j++) {
                            $weekdays[$j] = $weekday->format('j.n.y');
                            echo "<th>" . $weekday->format('j.n.y') . "<br>" . $this->weekdayNames[$weekday->format('N')] . "</th>";
                            $weekday->modify('+1 day');
                        }
                        ?>     
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->currentWeekSetList->getPlaceKeys() as $place_index) {
                        $shiftsFound = false;
                        for ($j = 0; $j < 7; $j++) {
                            if ($this->currentWeekSetList->getOrdersPlaceAndDate($place_index, $weekdays[$j]) != null) {
                                $shiftsFound = true;
                            }
                        }
                        if ($shiftsFound == true) {
                            echo "<tr>";
                            echo "<td>";
                            echo $this->currentWeekSetList->getPlaceName($place_index);
                            echo "</td>";
                            for ($j = 0; $j < 7; $j++) {
                                echo "<td>";
                                $orders = $this->currentWeekSetList->getOrdersPlaceAndDate($place_index, $weekdays[$j]);
                                if ($orders != null) {
                                    foreach ($orders as $order) {
                                        echo $order["time"] . "<br>";
                                        if (array_key_exists("name", $order)) {
                                            echo $order["name"] . "<br><br>";
                                        } else {
                                            echo "Ei tekijää<br><br>";
                                        }
                                    }
                                } else {
                                    // JOS ei ole vuoroa
                                }
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
            </table>
            <br/>
            <?php
        endfor;
        ?>
</div>


