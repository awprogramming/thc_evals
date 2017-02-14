<?php 
	if(isset($error))
		echo "<span class='error'>" . $error . "</span>";
?>
<form action="index.php?controller=users&action=create" method="post">
	<div class="form-group">
	    <label for="un">Username</label>
	    <input type="text" class="form-control" id="un" placeholder="Username" name="username" required>
  	</div>
  	<div class="form-group">
	    <label for="pw">Password</label>
	    <input type="password" class="form-control" id="pw" placeholder="Password" name="password" required>
	</div>
	<div class="form-group">
	    <label for="role">Role</label>
	    <select class="form-control" id="role" name="role" required>
	    	<option value="admin">Admin</option>
	    	<option value="evaluator">Evaluator</option>
	    	<option value="approver">Approver</option>
	    	<option value="office">Office</option>
	    </select>
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>