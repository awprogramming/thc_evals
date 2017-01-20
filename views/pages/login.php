<?php 
	if(isset($error))
		echo "<span class='error'>" . $error . "</span>";
?>
<form action="index.php?controller=auth&action=login" method="post">
	<input type="hidden" name="controller" value="auth">
	<input type="hidden" name="action" value="login">
	<div class="form-group">
	    <label for="un">Username</label>
	    <input type="text" class="form-control" id="un" placeholder="Username" name="username" required>
  	</div>
  	<div class="form-group">
	    <label for="pw">Password</label>
	    <input type="password" class="form-control" id="pw" placeholder="Password" name="password" required>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>

