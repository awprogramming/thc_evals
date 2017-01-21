<a href="?controller=users&action=create"><button class="btn">New User</button></a>
</br>
<table class='table'>
	<tr>
		<th>ID</th>
		<th>Username</th>
		<th>Role</th>
		<th></th>
	</tr>
<?php 
	$count = 0;
	foreach($users as $user) { 
?>
  <tr>
    <td><?php echo $user->id; ?></td>
    <td><?php echo $user->username; ?></td>
    <td><?php echo $user->role; ?></td>
<?php
	if($count!=0){
?>
    <td>
    	<form action="?controller=users&action=remove" method="post" onsubmit="return confirm('Do you really want to delete <?php echo $user->username; ?>?');">
    		<input name="id" value=<?php echo $user->id ?> hidden>
    		<input type="submit" value="X">
    	</form>
    	<form action="?controller=users&action=update_password" method="post" >
    		<input name="username" value=<?php echo $user->username ?> hidden>
    		<input name="id" value=<?php echo $user->id ?> hidden>
    		<input type="submit" value="Update Password">
    	</form>
    </td>
<?php
	}
	else{
?>
	<td></td>
<?php
	}
	$count++; 
?>
  </tr>
<?php } ?>
</table>