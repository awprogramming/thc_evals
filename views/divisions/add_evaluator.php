<?php 
	if(isset($error))
		echo "<span class='error'>" . $error . "</span>";
?>
<h1>Add evaluator to <?php echo urldecode($division_name) ?></h1>
<form action="index.php?controller=divisions&action=add_evaluator" method="post">
	<div class="form-group">
	    <label for="evaluator">Evaluator</label>
	    <select class="form-control" id="evaluator" name="evaluator" required>
<?php
	    	foreach($evaluators as $evaluator){
?>
	    	<option value="<?php echo $evaluator[0]; ?>"><?php echo $evaluator[1]; ?></option>
<?php
			}
?>
	    </select>
	</div>
	<input name="division_name" value="<?php echo $division_name; ?>" hidden>
	<input name="division_id" value="<?php echo $division_id; ?>" hidden>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>