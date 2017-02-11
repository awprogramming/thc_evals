<?php 
	if(isset($_SESSION['logged_in'])){
		switch($_SESSION['role']){
			case 'admin':
?>
			<li><a href='?controller=users&action=index'>Users</a></li>
			<li><a href='?controller=divisions&action=index'>Divisions</a></li>
			<li><a href='?controller=specialties&action=index'>Specialties</a></li>
			<li><a href='?controller=counselors&action=index'>Counselors</a></li>
			<li class='dropdown'>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Evaluations<span class="caret"></span></a>
          		<ul class="dropdown-menu">
          			<li><a href='?controller=divisions&action=get_mine'>Staff Evals</a></li>
            		<li><a href='?controller=evaluations&action=options'>Options</a></li>
          		</ul>
          	</li>
<?php
			break;
			case 'evaluator':
			break;
			case 'approver':
?>
			<li><a href='?controller=counselors&action=index'>Counselors</a></li>
<?php
			break;
		}
?>
		<li><a href='?controller=pages&action=profile'>Profile (<?php echo $_SESSION['username']; ?>)</a></li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings<span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href='?controller=users&action=update_password&nav=true'>Change Password</a></li>
            <li><a href='?controller=auth&action=logout'>Logout</a></li>
          </ul>
        </li>
      	
<?php
	} 
	else { 
?>
      <li><a href='?controller=pages&action=login'>Login</a></li>
<?php 
	} 
?>