<?php
    foreach ($divisions as $division => $counselors) {
?> 
<h1><?php echo $division ?></h1>
<table class='table'>
    <tr>
		<th>ID</th>
		<th>First</th>
		<th>Last</th>
        <th>Type</th>
	</tr>
<?php 
	   foreach($counselors as $counselor) { 
?>
  <tr>
    <td><?php echo $counselor->id; ?></td>
    <td><?php echo $counselor->first; ?></td>
    <td><?php echo $counselor->last; ?></td>
    <td><?php echo $counselor->type; ?></td>
  </tr>
<?php 
        }
?>
</table>
<?php
    }
?>