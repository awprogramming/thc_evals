<h1><?php echo $responses['first'] . ' ' . $responses['last']; ?>: Evaluation <?php echo $responses['num'] ?></h1>
<table class="table">
    <tr>
        <th>Question</th>
        <th>Score</th>
    </tr>
<?php 
    $count = 1;
    foreach($responses['responses'] as $response) { 
?>
  <tr>
    <td>
      <div class="form-group">
        <p><?php echo $count . ". "?><span class="question"><?php echo $response->question; ?></span></p>
        <input class="form-control score_slider" type="range" name="score" min="-3" value="<?php echo $response->score; ?>" max="5" step="1" disabled>
        <textarea class="form-control feedback" name="feedback" readonly><?php echo $response->feedback ?></textarea>
      </div>
    </td>
    <td><span class="score"><?php echo $response->score; ?></span></td>
  </tr>
<?php
    $count++; 
    }
?>
</table>
<div class="spacer"></div>
<div class="eval_summary">
    <img src="assets/ajax-loader.gif" hidden>
    <span class="saved">Saved</span>
    <span>Score: <span id="cur_score"></span></span>
    <span>Level: <span id="cur_level"></span></span>
    <form action="index.php?controller=evaluations&action=approve" method="post">
        <input value="<?php echo $evaluation_id ?>" name="evaluation_id" hidden>
        <input type="submit" value="Approve Evaluation">
    </form>
</div>