<?php 
	if(isset($error))
		echo "<span class='error'>" . $error . "</span>";
?>
<h1>Add approver to <?php echo urldecode($division_name) ?></h1>
<form action="index.php?controller=divisions&action=add_approver" method="post">
	<div class="form-group">
	    <label for="approver">Approver</label>
	    <select class="form-control" id="approver" name="approver" required>
<?php
	    	foreach($approvers as $approver){
?>
	    	<option value="<?php echo $approver[0]; ?>"><?php echo $approver[1]; ?></option>
<?php
			}
?>
	    </select>
	</div>
	<input name="division_name" value="<?php echo $division_name; ?>" hidden>
	<input name="division_id" value="<?php echo $division_id; ?>" hidden>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>