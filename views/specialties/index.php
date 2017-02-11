<a href="?controller=specialties&action=create"><button class="btn">New Specialty</button></a>  
<h1>Specialties</h1>
<table class='table'>
    <tr>
		<th>ID</th>
		<th>Specialty</th>
        <th></th>
	</tr>
<?php 
    foreach($specialties as $specialty) { 
?>
  <tr>
    <td><?php echo $specialty->id; ?></td>
    <td><?php echo $specialty->description; ?></td>
    <td>
        <form action="?controller=specialties&action=remove" method="post" onsubmit="return confirm('Do you really want to remove <?php echo $specialty->description?>?');">
            <input name="id" value=<?php echo $specialty->id; ?> hidden>
            <input type="submit" value="X">
        </form>
        <form action="?controller=specialties&action=update" method="post">
            <input name="id" value=<?php echo $specialty->id; ?> hidden>
            <input name="description" value=<?php echo $specialty->description; ?> hidden>
            <input type="submit" value="Edit">
        </form>
    </td>    
  </tr>
<?php
    }
?>
</table>