<a href="?controller=counselors&action=create"><button class="btn">New Counselor</button></a>  
<h1>Counselors</h1>
<h2>Boys Side</h2>
<table class='table'>
    <tr>
		<th>ID</th>
		<th>First</th>
		<th>Last</th>
        <th>Type</th>
        <th>Division</th>
        <th></th>
	</tr>
<?php 
	foreach($counselors['boys'] as $counselor) { 
?>
  <tr>
    <td><?php echo $counselor->id; ?></td>
    <td><?php echo $counselor->first; ?></td>
    <td><?php echo $counselor->last; ?></td>
    <td><?php echo $counselor->type; ?></td>
<?php
       if(is_null($counselor->division)){
?>
        <td>
            <form action="?controller=counselors&action=add_division" method="post">
                <input name="name" value=<?php echo urlencode($counselor->first . " " . $counselor->last) ?> hidden>
                <input name="id" value=<?php echo $counselor->id ?> hidden>
                <input name="gender" value=<?php echo $counselor->gender ?> hidden>
                <input type="submit" value="+">
            </form>
        </td>
<?php
        }
        else{
?>
        <td>
            <form action="?controller=counselors&action=change_division" method="post">
                <span><?php echo $counselor->division[1]; ?></span>
                <input name="id" value=<?php echo $counselor->id; ?> hidden>
                <input name="division_id" value=<?php echo $counselor->division[0]; ?> hidden>
                <input name="gender" value=<?php echo $counselor->gender; ?> hidden>
                 <input name="name" value=<?php echo urlencode($counselor->first . " " . $counselor->last) ?> hidden>
                <input type="submit" value="Change Division">
            </form>
        </td>
<?php
        }
?> 
        <td>
            <form action="?controller=counselors&action=remove" method="post" onsubmit="return confirm('Do you really want to remove <?php echo $counselor->first . " " . $counselor->last ?>?');">
                <input name="id" value=<?php echo $counselor->id; ?> hidden>
                <input type="submit" value="X">
            </form>
            <form action="?controller=counselors&action=update" method="post">
                <input name="id" value=<?php echo $counselor->id; ?> hidden>
                <input name="first" value=<?php echo $counselor->first; ?> hidden>
                <input name="last" value=<?php echo $counselor->last; ?> hidden>
                <input name="gender" value=<?php echo $counselor->gender; ?> hidden>
                <input name="type" value=<?php echo $counselor->type; ?> hidden>
                <input type="submit" value="Edit">
            </form>
        </td>    
  </tr>
<?php 
    }
?>
</table>
<h2>Girls Side</h2>
<table class='table'>
    <tr>
        <th>ID</th>
        <th>First</th>
        <th>Last</th>
        <th>Type</th>
        <th>Division</th>
        <th></th>
    </tr>
<?php 
    foreach($counselors['girls'] as $counselor) { 
?>
  <tr>
    <td><?php echo $counselor->id; ?></td>
    <td><?php echo $counselor->first; ?></td>
    <td><?php echo $counselor->last; ?></td>
    <td><?php echo $counselor->type; ?></td>
<?php
       if(is_null($counselor->division)){
?>
        <td>
            <form action="?controller=counselors&action=add_division" method="post">
                <input name="name" value=<?php echo urlencode($counselor->first . " " . $counselor->last) ?> hidden>
                <input name="id" value=<?php echo $counselor->id ?> hidden>
                <input name="gender" value=<?php echo $counselor->gender ?> hidden>
                <input type="submit" value="+">
            </form>
        </td>
<?php
        }
        else{
?>
        <td>
            <form action="?controller=counselors&action=change_division" method="post">
                <span><?php echo $counselor->division[1]; ?></span>
                <input name="id" value=<?php echo $counselor->id; ?> hidden>
                <input name="division_id" value=<?php echo $counselor->division[0]; ?> hidden>
                <input name="gender" value=<?php echo $counselor->gender; ?> hidden>
                 <input name="name" value=<?php echo urlencode($counselor->first . " " . $counselor->last) ?> hidden>
                <input type="submit" value="Change Division">
            </form>
        </td>
<?php
        }
?> 
        <td>
            <form action="?controller=counselors&action=remove" method="post" onsubmit="return confirm('Do you really want to remove <?php echo $counselor->first . " " . $counselor->last ?>?');">
                <input name="id" value=<?php echo $counselor->id; ?> hidden>
                <input type="submit" value="X">
            </form>
            <form action="?controller=counselors&action=update" method="post">
                <input name="id" value=<?php echo $counselor->id; ?> hidden>
                <input name="first" value=<?php echo $counselor->first; ?> hidden>
                <input name="last" value=<?php echo $counselor->last; ?> hidden>
                <input name="gender" value=<?php echo $counselor->gender; ?> hidden>
                <input name="type" value=<?php echo $counselor->type; ?> hidden>
                <input type="submit" value="Edit">
            </form>
        </td>    
  </tr>
<?php 
    }
?>
</table>