<h1><?php echo $responses['first'] . ' ' . $responses['last']; ?>: Evaluation <?php echo $responses['num'] ?></h1>
<h2>General Counselor Questions</h2>
<table class="table">
    <tr>
        <th>Question</th>
        <th>Score</th>
    </tr>
<?php 
    $count = 1;
	foreach($responses['responses'] as $response) {
        if($response->type=='GC'){ 
?>
  <tr>
    <td>
      <div class="form-group">
        <p><?php echo $count . ". "?><span class="question"><?php echo $response->question; ?></span></p>
        <input class="evaluation_id" value=<?php echo $response->evaluation_id ?> hidden>
        <input class="form-control score_slider" type="range" name="score" min="<?php echo $options['low'] ?>" value="<?php echo $response->score; ?>" max="<?php echo $options['high'] ?>" step="1">
        <textarea class="form-control feedback" name="feedback" ><?php echo $response->feedback ?></textarea>
      </div>
    </td>
    <td><span class="score"><?php echo $response->score; ?></span></td>
  </tr>
<?php
    $count++;
        } 
    }
?>
</table>
<?php
    if($type!='GC'){
        if($type=='S'){
?>
    <h2>Specialist Questions</h2>
<?php   
        }
        else{
?>
    <h2>Group Leader Questions</h2>
<?php
        }
?>
    <table class="table">
    <?php 
    foreach($responses['responses'] as $response) {
        if($response->type=='S'){ 
?>
  <tr>
    <td>
      <div class="form-group">
        <p><?php echo $count . ". "?><span class="question"><?php echo $response->question; ?></span></p>
        <input class="evaluation_id" value=<?php echo $response->evaluation_id ?> hidden>
        <input class="form-control score_slider" type="range" name="score" min="<?php echo $options['low'] ?>" value="<?php echo $response->score; ?>" max="<?php echo $options['high'] ?>" step="1" disabled>
        <textarea class="form-control feedback" name="feedback" readonly><?php echo $response->feedback ?></textarea>
      </div>
    </td>
    <td><span class="score"><?php echo $response->score; ?></span></td>
  </tr>
<?php
    $count++;
        } 
        else if($response->type=='GL'){ 
?>
  <tr>
    <td>
      <div class="form-group">
        <p><?php echo $count . ". "?><span class="question"><?php echo $response->question; ?></span></p>
        <input class="evaluation_id" value=<?php echo $response->evaluation_id ?> hidden>
        <input class="form-control score_slider" type="range" name="score" min="<?php echo $options['low'] ?>" value="<?php echo $response->score; ?>" max="<?php echo $options['high'] ?>" step="1">
        <textarea class="form-control feedback" name="feedback"><?php echo $response->feedback ?></textarea>
      </div>
    </td>
    <td><span class="score"><?php echo $response->score; ?></span></td>
  </tr>
<?php
    $count++;
        }
    }
}
?>
</table>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="eval_summary">
    <table class='table'>
        <tr>
            <td>
                <img src="assets/ajax-loader.gif" hidden>
                <span class="saved">Saved</span>
            </td>
            <td><span>Score: <span id="cur_score"></span></span></td>
            <td><span>Level: <span id="cur_level"></span></span></td>
            <td>
                <form action="index.php?controller=evaluations&action=submit" method="post">
                    <input value="<?php echo $evaluation_id ?>" name="evaluation_id" hidden>
                    <input type="submit" value="Submit Evaluation">
                </form>
            </td>
        </tr>
    </table>
</div>
<script>
    var calculate_score = function(){
        var count = 0;
        var total = 0;
        $('.score_slider').each(function(){total+=parseInt($(this).val()); count++;});
        count *= 5;
        var percentage = (total/count) * 100
        return percentage.toFixed(0);
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
    $('#cur_score').html(cur_score+"%");
    calculate_level(cur_score);

    $('.score_slider').on('input', function(){
        var cur_score = calculate_score()
        $('#cur_score').html(cur_score+'%');
        calculate_level(cur_score);
        $(this).parent().parent().parent().find('.score').html($(this).val());
        var score = $(this).val();
        var feedback = $(this).next().val();
        var evaluation_id = $(this).prev().val();
        var question = $(this).prev().prev().find('.question').html();
        $('.saved').hide();
        $('.eval_summary img').show();

        $.ajax('ajax_preroute.php',
        {
            type: 'POST',
            data: {controller:'evaluations',
                   action:'save_response',
                   feedback:feedback,
                   score:score,
                   evaluation_id:evaluation_id,
                   question:question},
            cache: true,
            success: function (data) {$('.eval_summary img').hide();$('.saved').show();}, 
            error: function () {alert("Grab Failure");}
        });
    });
        $('.feedback').on('input', function(){
        var score = $(this).prev().val();
        var feedback = $(this).val();
        var evaluation_id = $(this).prev().prev().val();
        var question = $(this).prev().prev().prev().find('.question').html();
        $('.saved').hide();
        $('.eval_summary img').show();
        
        $.ajax('ajax_preroute.php',
        {
            type: 'POST',
            data: {controller:'evaluations',
                   action:'save_response',
                   feedback:feedback,
                   score:score,
                   evaluation_id:evaluation_id,
                   question:question},
            cache: true,
            success: function (data) {$('.eval_summary img').hide();$('.saved').show();}, 
            error: function () {alert("Grab Failure");}
        });
    });
    
</script>