<h1>Tervetuloa <?php echo Session::get('username');?></h1>

Tänään on <?php print date('D, d M Y H:i:s T');?>.

Tämä sivu edustaa MVC mallia.

<?php echo $_SESSION['login']; ?>
