
<a href="?controller=evaluations&action=create_question"><button class="btn">New Question</button></a>  
<h1>General Counselor</h1>
<table class='table'>
    <tr>
		<th>ID</th>
		<th>Question</th>
        <th></th>
	</tr>
<?php 
	foreach($general as $question) { 
?>
  <tr>
    <td><?php echo $question->id; ?></td>
    <td><?php echo $question->content; ?></td>
    <td>
        <form action="?controller=evaluations&action=remove_question" method="post" onsubmit="return confirm('Do you really want to remove this question?');">
            <input name="id" value=<?php echo $question->id; ?> hidden>
            <input type="submit" value="X">
        </form>
        <form action="?controller=evaluations&action=update_question" method="post">
            <input name="id" value=<?php echo $question->id; ?> hidden>
            <input name="content" value=<?php echo urlencode($question->content); ?> hidden>
            <input type="submit" value="Edit">
        </form>
    </td>    
  </tr>
<?php 
    }
?>
</table>
<h1>Specialist</h1>
<table class='table'>
    <tr>
        <th>ID</th>
        <th>Question</th>
        <th></th>
    </tr>
<?php 
    foreach($specialist as $question) { 
?>
  <tr>
    <td><?php echo $question->id; ?></td>
    <td><?php echo $question->content; ?></td>
    <td>
        <form action="?controller=evaluations&action=remove_question" method="post" onsubmit="return confirm('Do you really want to remove this question?');">
            <input name="id" value=<?php echo $question->id; ?> hidden>
            <input type="submit" value="X">
        </form>
        <form action="?controller=evaluations&action=update_question" method="post">
            <input name="id" value=<?php echo $question->id; ?> hidden>
            <input name="content" value=<?php echo urlencode($question->content); ?> hidden>
            <input type="submit" value="Edit">
        </form>
    </td>    
  </tr>
<?php 
    }
?>
</table>
<h1>Group Leader</h1>
<table class='table'>
    <tr>
        <th>ID</th>
        <th>Question</th>
        <th></th>
    </tr>
<?php 
    foreach($gl as $question) { 
?>
  <tr>
    <td><?php echo $question->id; ?></td>
    <td><?php echo $question->content; ?></td>
    <td>
        <form action="?controller=evaluations&action=remove_question" method="post" onsubmit="return confirm('Do you really want to remove this question?');">
            <input name="id" value=<?php echo $question->id; ?> hidden>
            <input type="submit" value="X">
        </form>
        <form action="?controller=evaluations&action=update_question" method="post">
            <input name="id" value=<?php echo $question->id; ?> hidden>
            <input name="content" value=<?php echo urlencode($question->content); ?> hidden>
            <input type="submit" value="Edit">
        </form>
    </td>    
  </tr>
<?php 
    }
?>
</table>