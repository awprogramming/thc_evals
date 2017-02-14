<form action="index.php?controller=evaluations&action=create_question" method="post">
	<div class="form-group">
	    <label for="content">Question</label>
	    <textarea class="form-control" id="content" name="content" required></textarea>
  	</div>
  	<div class="form-group">
	    <label for="type">Type</label>
	    <select class="form-control" id="type" name="type" required>
	    	<option value="GC">General Counselor</option>
	    	<option value="S">Specialist</option>
	    	<option value="GL">Group Leader</option>
	    </select>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>