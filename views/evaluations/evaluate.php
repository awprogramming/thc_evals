<h1>Counselor Evaluation</h1>
<?php 
    $count = 1;
	foreach($responses as $response) { 
?>
  <div>
    <p><?php echo $count . "." . $response->question; ?> </p>
    <input type="range" name="grade" min="-3" value="<?php echo $response->grade; ?>" max="5" step="1">
    <textarea name="response"><?php echo $response->feedback ?></textarea>
  </div>
<?php
    $count++; 
    }
?>
</table>