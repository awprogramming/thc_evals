<h1>Add Specialty to <?php echo urldecode($name) ?></h1>
<form action="index.php?controller=counselors&action=add_specialty" method="post">
	<div class="form-group">
	    <label for="evaluator">Specialties</label>
	    <select class="form-control" id="specialty" name="specialty_id" required>
<?php
	    	foreach($specialties as $specialty){
?>
	    	<option value="<?php echo $specialty[0]; ?>"><?php echo $specialty[1]; ?></option>
<?php
			}
?>
	    </select>
	</div>
	<input name="id" value="<?php echo $id; ?>" hidden>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>