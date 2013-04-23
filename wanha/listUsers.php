<?php
include ('lock.php');
echo '<table border = "1">
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
    echo "<tr><form action=\"correctUsers.php\" method=\"POST\">\n";
    echo "\t<td>" . $value->username . "<input type = \"hidden\" name = \"username\" value = \"" . ($value->username) . "\"/></td>\n";
    echo "\t<td>" . $value->firstname . "<input type = \"hidden\" name = \"firstname\" value = \"" . ($value->firstname) . "\"/></td>\n";
    echo "\t<td>" . $value->lastname . "<input type = \"hidden\" name = \"lastname\" value = \"" . ($value->lastname) . "\"/></td>\n";
    echo "\t<td>" . $value->address . "<input type = \"hidden\" name = \"address\" value = \"" . ($value->address) . "\"/></td>\n";
    echo "\t<td>" . $value->email . "<input type = \"hidden\" name = \"email\" value = \"" . ($value->email) . "\"/></td>\n";
    echo "\t<td>" . $value->role . "<input type = \"hidden\" name = \"role\" value = \"" . ($value->role) . "\"/></td>\n";
    echo "\t<td><input type=\"submit\" value=\"Korjaa\" /></td>\n";
    echo "</form></tr>\n";
}
?>
</tbody>
</table><br>
<a href="newUser.php">Lisää uusi käyttäjä</a>
<!--
Set the name in the form to check_list[] and you will be able to access all the checkboxes as an array($_POST["check_list'][]).

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
