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
        <td>Eval 1</td>
        <td>Eval 2</td>
        <td>Eval 3</td>
	</tr>
<?php 
	   foreach($counselors as $counselor) { 
?>
  <tr>
    <td><?php echo $counselor->id; ?></td>
    <td><?php echo $counselor->first; ?></td>
    <td><?php echo $counselor->last; ?></td>
    <td><?php echo $counselor->type; ?></td>
<?php
    $num_evals = count($counselor->evals);
    foreach($counselor->evals as $eval){
        if($eval->submitted==0)
            $class = 'red';
        else if($eval->approved==0)
            $class = 'yellow';
        else
            $class = 'green';
?>
    <td class="<?php echo $class?>">
        <form action="?controller=evaluations&action=view" method="post">
            <input name="evaluation_id" value=<?php echo $eval->id ?> hidden>
            <input name="evaluation_type" value=<?php echo $eval->type ?> hidden>
            <input type="submit" value="View" class="btn">
        </form>
        <span><?php echo $eval->level . ": " . $eval->score . "%" ?></span>
    </td>
<?php 
    }
    for($i = 3-$num_evals; $i > 0; $i--){
?>
    <td class="red">Not yet started.</td>
<?php
    }
?>
</tr>
<?php
  }
?>
</table>
<?php
}
?>
