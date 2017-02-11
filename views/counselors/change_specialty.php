<h1>Change Specialty for <?php echo urldecode($name) ?></h1>
<form action="index.php?controller=counselors&action=change_specialty" method="post">
	<div class="form-group">
	    <label for="evaluator">Specialties</label>
	    <select class="form-control" id="specialty" name="specialty_id" required>
<?php
	    	foreach($specialties as $specialty){
?>
	    	<option value="<?php echo $specialty[0]; ?>" <?php if($specialty_id==$specialty[0]){echo "selected";} ?>><?php echo $specialty[1]; ?></option>
<?php
			}
?>
	    </select>
	</div>
	<input name="id" value="<?php echo $id; ?>" hidden>
	<input name="changed" value="true" hidden>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>