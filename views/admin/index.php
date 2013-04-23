<table>
<?php
	foreach($this->userList as $key => $value) {
		echo '<tr>';
		echo '<td>' . $value['id'] . '</td>';
		echo '<td>' . $value['login'] . '</td>';
		echo '<td>' . $value['role'] . '</td>';
		echo '<td>
				<a href="'.URL.'user/edit/'.$value['id'].'">Edit</a> 
				<a href="'.URL.'user/delete/'.$value['id'].'">Delete</a></td>';
		echo '</tr>';
	}
?>
</table>