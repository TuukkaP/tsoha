<?php
if (!empty($_POST['weeks']) && !empty($_POST['users'])) {
    header("location: " . filter_var(trim(URL . "orders/index/" . $_POST['weeks'] . "/" . $_POST['users']), FILTER_SANITIZE_URL));
} else if (!empty($_POST['weeks']) && empty($_POST['users'])) {
    header("location: " . filter_var(trim(URL . "orders/index/" . $_POST['weeks']), FILTER_SANITIZE_URL));
}
$date = $this->begin;
$dateCopy = clone $date;
$showDate = $dateCopy->modify("-" . ($dateCopy->format("N") - 1) . " day");
echo "<h1>Tilaukset ::" . $showDate->format("j.n.y") . "-" . $showDate->modify("+27 day")->format("j.n.y") . "</h1>";
?>
<form action="" method="POST">
    <label>Valitse vuosi: </label><select name="year">
        <?php
        for ($y = 13; $y < 16; $y++) { // 2013 on aloitusvuosi
            echo "<option value=\"" . $y . "\"";
            if (!empty($_POST['year']) && $_POST['year'] == $y) {
                $year = $_POST['year'];
                echo "selected";
            } else if ($date->format("y") == $y && empty($_POST['year'])) {
                $year = $date->format("y");
                echo "selected";
            }
            echo ">20" . $y . "</option>";
        }
        ?>
    </select>
    <input type="submit" value="Valitse" name="submit" />
</form>
<form action="" method="POST">
    <label>Hae viikot: </label>
    <select name="weeks">
        <?php
        if ($year == null) {
            $year = (new DateTime('this year'))->format('y');
        }
        $firstDayOfTheYear = new DateTime("first day of January 20" . $year);
        $from = $firstDayOfTheYear;

        while ($from->format('y') == $year) {
            $to = clone $from;
            $to->modify("+28 days");
            $to->modify("-" . ($to->format("N")) . "day");
            echo "<option value=\"" . $from->format('j.n.y') . "\" "; // selectin value
            if ($from <= $this->begin && $to >= $this->begin) { // jos päivä osuu tälle välille valitaan se oletusarvoisesti dropdownista.
                echo "selected";
            }
            echo " /> Viikot: " . $from->format('W') . "-" . $to->format("W") . " (" . $from->format("j.n.y") . "-" . $to->format('j.n.y') . ")</option>";
            $from->modify("+4 week");
            $from->modify("-" . ($from->format("N") - 1) . "day");
        }
        ?>
    </select>
    <br>
    <label>Valitse työntekijä: </label>
    <select name="users">
        <option value="all" <?php if ($this->selectedUser == "all") echo "selected"; ?>>Kaikki</option>
        <?php
        foreach ($this->currentWeekSetList->getUserList() as $user_id => $user) {
            echo "<option value=\"" . $user_id . "\"";
            if ($this->selectedUser == $user_id) {
                echo "selected";
            }
            echo ">" . $user . "</option>";
        }
        ?>
    </select>
    <input type="submit" value="Hae" name="" />
</form>
<br>
<?php echo "Työvuoroja löytyi " . $this->currentWeekSetList->countOrders(); ?>
<br>