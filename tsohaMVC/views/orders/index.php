<?php 
include 'ordersMenu.php';

?>
<div class="OrdersTable" >
    <!--Format 1.4.13-->
        <?php
//    print_r($this->currentWeekSetList->getArray());
//    print_r($this->currentWeekSetList->getUserList());
    $weekday = $this->begin;
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
                $place_index = 0;
                while ($place_index < count($this->currentWeekSetList->getPlaces())) {
                    echo "<tr>";
                    echo "<td>";
                    echo $this->currentWeekSetList->getPlaces()[$place_index];
                    echo "</td>";
                    for ($j = 0; $j < 7; $j++) {
                        echo "<td>";
                        if (($orders = $this->currentWeekSetList->getOrdersPlaceAndDate($this->currentWeekSetList->getPlaces()[$place_index], $weekdays[$j])) != null) {
                            foreach ($orders as $order) {
                                echo $order["time"] . "<br>";
                                echo $order["worker"] . "<br><br>";
                            }
                        } else {
                            echo "Ei vuoroa";
                        }
                    }
                    echo "</td>";
                    echo "</tr>";
                    $place_index++;
                }
                ?>
        </table>
        <br/>
        <?php
//        $date->modify('+1 week');
    endfor;
    ?>
    <a href="<?php echo URL . 'orders/index/15.4.13'; ?>">Lisää uusi käyttäjä</a> <br>
</div>


