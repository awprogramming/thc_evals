<form action="index.php?controller=counselors&action=update" method="post">
	<div class="form-group">
	    <label for="fn">First Name</label>
	    <input type="text" class="form-control" id="fn" placeholder="First Name" value=<?php echo $first ?> name="first" required>
  	</div>
  	<div class="form-group">
	    <label for="ln">Last Name</label>
	    <input type="text" class="form-control" id="ln" placeholder="Last Name" value=<?php echo $last ?> name="last" required>
	</div>
	<div class="form-group">
	    <label for="gender">Gender</label>
	    <select class="form-control" id="gender" name="gender" required>
<?php 
	if($gender == 'm'){
?>
	    	<option value="m" selected>Male</option>
	    	<option value="f">Female</option>
<?php
	}
	else{
?>	    
			<option value="m">Male</option>
	    	<option value="f" selected>Female</option>
<?php 
	    }
?>
		</select> 
	</div>
	<div class="form-group">
	    <label for="type">Type</label>
	    <select class="form-control" id="type" name="type" required>
<?php
		foreach ($types as $t) {
?>
		<option value="<?php echo $t ?>" <?php if($t==$type){echo "selected"} ?>><?php echo $t ?></option>
<?php
		}
?>
		</select> 
	</div>
	<input name="updated" value="true" hidden>
	<input name="id" value= <?php echo $id ?> hidden>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>