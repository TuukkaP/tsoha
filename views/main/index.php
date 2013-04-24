<h1>Tervetuloa <?php echo Session::get('username');?></h1>
<?php
if (isset($this->msg)) {
    echo "<br>".$this->msg."<br>";
}

?>
Tänään on <?php print date('D, d M Y H:i:s T');?>.

Tämä sivu edustaa MVC mallia.
<br><br>
<?php print_r($_SESSION); 
echo $_SESSION["id"];
echo Session::get("id");
?>
<br>
Todo
<ul>
    <li>Yleinen postmuuttujien käsittelijä</li>
    <li>Users vuorolistaus</li>
    <li>Users salasanan vaihto</li>
    <li><i>Tyhjien vuorojen toiminnallisuus</i></li>
    <li>Javascriptillä vuorojen päivitys helpommaksi (ei sama työntekijä monessa paikassa)</li>
    <li>Ulkoasu</li>
    <li>Vuoron poistaminen</li>
    <li><i>Muutoksen ja/tai vuoron lisäyksen jälkeen palataan samaan aikaikkunaan</i></li>
</ul>

