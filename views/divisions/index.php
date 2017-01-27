<h1>Divisions</h1>
<h2>Boys Side</h2>
<table class='table'>
    <tr>
		<th>ID</th>
		<th>Division</th>
		<th>Evaluators</th>
        <th>Approvers</th>
	</tr>
<?php 
	foreach($divisions['boys'] as $division) { 
?>
  <tr>
    <td><?php echo $division->id; ?></td>
    <td><?php echo $division->name; ?></td>
    <td>
<?php
        foreach($division->evaluators as $evaluator){
?>
        <form action="?controller=divisions&action=remove_evaluator" method="post" onsubmit="return confirm('Do you really want to remove <?php echo $evaluator[0] ?>?');">
            <span><?php echo $evaluator[0]; ?></span>
            <input name="user_id" value=<?php echo $evaluator[1]; ?> hidden>
            <input name="division_id" value=<?php echo $division->id; ?> hidden>
            <input type="submit" value="X">
        </form>
<?php
        }
?>
        <form action="?controller=divisions&action=add_evaluator" method="post">
            <input name="division_id" value=<?php echo $division->id ?> hidden>
            <input name="division_name" value=<?php echo urlencode($division->name) ?> hidden>
            <input type="submit" value="+">
        </form>
    </td>
    <td>
<?php
        foreach($division->approvers as $approver){
?>
        <form action="?controller=divisions&action=remove_approver" method="post" onsubmit="return confirm('Do you really want to remove <?php echo $approver[0] ?>?');">
            <span><?php echo $approver[0]; ?></span>
            <input name="user_id" value=<?php echo $approver[1]; ?> hidden>
            <input name="division_id" value=<?php echo $division->id; ?> hidden>
            <input type="submit" value="X">
        </form>
<?php
        }
?>
        <form action="?controller=divisions&action=add_approver" method="post">
            <input name="division_id" value=<?php echo $division->id ?> hidden>
            <input name="division_name" value=<?php echo urlencode($division->name) ?> hidden>
            <input type="submit" value="+">
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
        <th>Division</th>
        <th>Evaluators</th>
        <th>Approvers</th>
    </tr>
<?php 
    foreach($divisions['girls'] as $division) { 
?>
  <tr>
    <td><?php echo $division->id; ?></td>
    <td><?php echo $division->name; ?></td>
    <td>
<?php
        foreach($division->evaluators as $evaluator){
?>
        <form action="?controller=divisions&action=remove_evaluator" method="post" onsubmit="return confirm('Do you really want to remove <?php echo $evaluator[0] ?>?');">
            <span><?php echo $evaluator[0]; ?></span>
            <input name="user_id" value=<?php echo $evaluator[1]; ?> hidden>
            <input name="division_id" value=<?php echo $division->id; ?> hidden>
            <input type="submit" value="X">
        </form>
<?php
        }
?>
        <form action="?controller=divisions&action=add_evaluator" method="post">
            <input name="division_id" value=<?php echo $division->id ?> hidden>
            <input name="division_name" value=<?php echo urlencode($division->name) ?> hidden>
            <input type="submit" value="+">
        </form>
    </td>
    <td>
<?php
        foreach($division->approvers as $approver){
?>
        <form action="?controller=divisions&action=remove_approver" method="post" onsubmit="return confirm('Do you really want to remove <?php echo $approver[0] ?>?');">
            <span><?php echo $approver[0]; ?></span>
            <input name="user_id" value=<?php echo $approver[1]; ?> hidden>
            <input name="division_id" value=<?php echo $division->id; ?> hidden>
            <input type="submit" value="X">
        </form>
<?php
        }
?>
        <form action="?controller=divisions&action=add_approver" method="post">
            <input name="division_id" value=<?php echo $division->id ?> hidden>
            <input name="division_name" value=<?php echo urlencode($division->name) ?> hidden>
            <input type="submit" value="+">
        </form>
    </td>
  </tr>
<?php 
    }
?>
</table>