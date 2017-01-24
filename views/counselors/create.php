<form action="index.php?controller=counselors&action=create" method="post">
	<div class="form-group">
	    <label for="fn">First Name</label>
	    <input type="text" class="form-control" id="fn" placeholder="First Name" name="first" required>
  	</div>
  	<div class="form-group">
	    <label for="ln">Last Name</label>
	    <input type="text" class="form-control" id="ln" placeholder="Last Name" name="last" required>
	</div>
	<div class="form-group">
	    <label for="gender">Gender</label>
	    <select class="form-control" id="gender" name="gender" required>
	    	<option value="m">Male</option>
	    	<option value="f">Female</option>
	    </select>
	</div>
	<div class="form-group">
	    <label for="type">Type</label>
	    <select class="form-control" id="type" name="type" required>
	    	<option value="General Counselor">General Counselor</option>
	    	<option value="Specialist">Specialist</option>
	    	<option value="Group Leader">Group Leader</option>
	    </select>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>