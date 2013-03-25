<?php

include ('lock.php');
echo '<form action="correctUser.php" method="POST">
      <table border = "1">
      <thead> 
      <tr>
      <th>Käyttäjänimi</th>
      <th>Etunimi</th>
      <th>Sukunimi</th>
      <th>Osoite</th>
      <th>Email</th>
      <th>Käyttöoikeus</th>
      <th>Korjaa</th>
      </tr>
      </thead>
      <tbody>';
$array = $queries->listAllUsers();
foreach ($array as $value) {
    echo "<tr>";
    echo "<td>" . $value->username . "</td>";
    echo "<td>" . $value->firstname . "</td>";
    echo "<td>" . $value->lastname . "</td>";
    echo "<td>" . $value->address . "</td>";
    echo "<td>" . $value->email . "</td>";
    echo "<td>" . $value->role . "</td>";
    echo "<td>";?><input type = "checkbox" name = "checkboxList[]" value = "<?php ($value->username) ?>"/></td>
    <?php echo "</tr>";
}
?>
      </tbody>
      </table>
      <input type="submit" value="Korjaa valitut" />
      </form>
    <!--
Set the name in the form to check_list[] and you will be able to access all the checkboxes as an array($_POST['check_list'][]).

Here's a little sample as requested:

<form action="test.php" method="post">
<input type="checkbox" name="check_list[]" value="value 1">
<input type="checkbox" name="check_list[]" value="value 2">
<input type="checkbox" name="check_list[]" value="value 3">
<input type="checkbox" name="check_list[]" value="value 4">
<input type="checkbox" name="check_list[]" value="value 5">
<input type="submit" />
</form>
?php
if(!empty($_POST['check_list'])) {
    foreach($_POST['check_list'] as $check) {
            echo $check; //echoes the value set in the HTML form for each checked checkbox.
                         //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
                         //in your case, it would echo whatever $row['Report ID'] is equivalent to.
    }
}
?>
--!>
