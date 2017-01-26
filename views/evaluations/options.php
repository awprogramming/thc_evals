<h1>Options</h1>
<form action="index.php?controller=evaluations&action=update_options" method="post">
<?php
	foreach($options as $option => $value){
?>
	<div class="form-group">
	    <label for="<?php echo $option ?>"><?php echo $option ?></label>
	    <input type="text" class="form-control" id="<?php echo $option ?>" placeholder="<?php echo $option ?>" value=<?php echo $value ?> name="<?php echo $option ?>" required>
  	</div>
<?php
	}
?>
	<input type="submit" value="Submit Options">
</form>
