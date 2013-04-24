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
//    print_r($this->currentWeekSetList->getArray());
    $weekday = $this->begin;
//    $weekday = new DateTime('2013-01-01');
    for ($i = 0; $i < 4; $i++):
        ?>
        <table class="OrdersTable">
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
                    echo "<tr>";
                    echo "<td>";
                    echo $this->currentWeekSetList->getPlaceName($place_index);
                    echo "</td>";
                    for ($j = 0; $j < 7; $j++) {
                        echo "<td>";
                        if (($orders = $this->currentWeekSetList->getOrdersPlaceAndDate($place_index, $weekdays[$j])) != null) {
                            foreach ($orders as $order) {
                                echo "<a href=\"" . URL . "orders/editOrder/" . $order["order_id"] . "\">";
                                echo $order["time"] . "<br>";
                                if (array_key_exists("name", $order)) {
                                    echo $order["name"] . "<br><br>";
                                } else {
                                    echo "Ei tekijää<br><br>";
                                }
                                echo "</a>";
                            }
                            echo "<a href=\"" . URL . "orders/addOrder/" . $weekdays[$j] . "/" . $place_index . "\">Lisää vuoro</a>";
                        } else {
                            echo "<a href=\"" . URL . "orders/addOrder/" . $weekdays[$j] . "/" . $place_index . "\">Ei vuoroa</a>";
                        }
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
        </table>
        <br/>
        <?php
    endfor;
    ?>
</div>


