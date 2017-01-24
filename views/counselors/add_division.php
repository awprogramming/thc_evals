<h1>Add Division to <?php echo urldecode($name) ?></h1>
<form action="index.php?controller=counselors&action=add_division" method="post">
	<div class="form-group">
	    <label for="evaluator">Divisions</label>
	    <select class="form-control" id="division" name="division_id" required>
<?php
	    	foreach($divisions as $division){
?>
	    	<option value="<?php echo $division[0]; ?>"><?php echo $division[1]; ?></option>
<?php
			}
?>
	    </select>
	</div>
	<input name="id" value="<?php echo $id; ?>" hidden>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>