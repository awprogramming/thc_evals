<form action="index.php?controller=specialties&action=update" method="post">
	<div class="form-group">
	    <label for="description">Description</label>
	    <input type="text" class="form-control" id="description" placeholder="Description" value=<?php echo $description ?> name="description" required>
  	</div>
	<input name="updated" value="true" hidden>
	<input name="id" value= <?php echo $id ?> hidden>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>