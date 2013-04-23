<?php
if (!empty($_POST['weeks']) && !empty($_POST['users']) && !empty($_POST["place_id"])) {
    header("location: " . filter_var(trim(URL . "orders/index/" . $_POST["place_id"] . "/" . $_POST['weeks'] . "/" . $_POST['users']), FILTER_SANITIZE_URL));
}
$date = $this->begin;
$dateCopy = clone $date;
$showDate = $dateCopy->modify("-" . ($dateCopy->format("N") - 1) . " day");
echo "<h1>Tilaukset :: " . $showDate->format("j.n.y") . "-" . $showDate->modify("+27 day")->format("j.n.y") . "</h1>";
?>
<form action="" method="POST">
    <label>Valitse vuosi: </label><select name="year">
        <?php
        for ($y = 13; $y < 18; $y++) { // 2013 on aloitusvuosi
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
            $to->modify("+28 days")->modify("-" . ($to->format("N")) . "day");
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
        foreach ($this->userList as $user) {
            echo "<option value=\"" . $user["id"] . "\"";
            if ($this->selectedUser == $user["id"]) {
                echo "selected";
            }
            echo ">" . $user["name"] . "</option>";
        }
        ?>
        <option value="none" <?php if ($this->selectedUser == "none") echo "selected"; ?>>Vapaat vuorot</option>
    </select>
    <br>
    <label>Valitse paikka: </label>
    <select name="place_id" value="options">
        <option value="all" <?php if ($this->place_id == "all") echo "selected"; ?>>Kaikki paikat joihin on vuoroja</option>
        <?php
        foreach ($this->places as $place) {
            echo "<option value=\"" . $place["id"] . "\"";
            if ($this->place_id == $place["id"]) {
                echo "selected";
            }
            echo ">" . $place["name"] . "</option>";
        }
        ?>
    </select><br>
    <label>&nbsp;</label><input type="submit" value="Hae" name="" />
</form>
<a href="<?php echo URL . 'orders/addOrder/' . $this->begin->format('j.n.y'); ?>">Lisää vuoro</a> <br>
<br>
<?php echo "Työvuoroja löytyi " . $this->currentWeekSetList->countOrders(); ?>
<br>