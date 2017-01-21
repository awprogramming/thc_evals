<form action="index.php?controller=users&action=update_password" method="post">
  	<div class="form-group">
	    <label for="pw">New Password for <?php echo $username; ?></label>
	    <input name="id" value="<?php echo $id; ?>" hidden>
	    <input type="password" class="form-control" id="pw" placeholder="Password" name="password" required>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>