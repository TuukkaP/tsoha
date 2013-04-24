<h1>Tervetuloa <?php echo Session::get('username');?></h1>
<?php
if (isset($this->msg)) {
    echo "<br>".$this->msg."<br>";
}

?>
Tänään on <?php print date('D, d M Y H:i:s T');?>.

Tämä sivu edustaa MVC mallia.
<br><br>
<br>
Todo
<ul>
    <li>Demo</li>
</ul>

