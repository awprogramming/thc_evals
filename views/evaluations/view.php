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
        <input class="form-control score_slider" type="range" name="score" min="<?php echo $options['low'] ?>" value="<?php echo $response->score; ?>" max="<?php echo $options['high'] ?>" step="1" disabled>
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
<div class="spacer"></div>
<div class="spacer"></div>
<div class="eval_summary">
    <table class='table'>
        <tr>
            <td><span>Score: <span id="cur_score"></span></span></td>
            <td><span>Level: <span id="cur_level"></span></span></td>
            <td>
                <form action="index.php?controller=evaluations&action=approve" method="post">
                    <input value="<?php echo $evaluation_id ?>" name="evaluation_id" hidden>
<?php 
                    if($_SESSION['role']=='approver'){
?>
                    <input type="submit" value="Approve Evaluation">
<?php 
                    }
?>
                </form>
            </td>
        </tr>
    </table>
</div>
<script>
var calculate_score = function(){
        var total = 0;
        $('.score_slider').each(function(){total+=parseInt($(this).val())});
        return total;
    }

    var calculate_level = function(score){
        var gold = parseInt(<?php echo $options['gold'] ?>);
        var silver = parseInt(<?php echo $options['silver'] ?>);
        var green = parseInt(<?php echo $options['green'] ?>);
        var red = parseInt(<?php echo $options['red'] ?>);

        if(score >= gold)
            $('#cur_level').html("Gold");
        else if(score >= silver)
            $('#cur_level').html("Silver");
        else if(score >= green)
            $('#cur_level').html("Green");
        else
            $('#cur_level').html("Red");
    }

    var cur_score = calculate_score();
    $('#cur_score').html(cur_score);
    calculate_level(cur_score);
</script>