<form action="index.php?controller=evaluations&action=update_question" method="post">
	<div class="form-group">
	    <label for="content">Question</label>
	    <textarea class="form-control" id="content" name="content" required><?php echo urldecode($content) ?></textarea>
  	</div>
  	<input value=<?php echo $id ?> name="id" hidden>
  	<input value="true" name="updated" hidden>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>