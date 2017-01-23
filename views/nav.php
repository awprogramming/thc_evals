<?php 
	if(isset($_SESSION['logged_in'])){
		switch($_SESSION['role']){
			case 'admin':
?>
			<li><a href='?controller=users&action=index'>Users</a></li>
			<li><a href='?controller=divisions&action=index'>Divisions</a></li>
<?php
			break;
			case 'evaluator':
			break;
		}
?>
		<li><a href='index.php'>Profile (<?php echo $_SESSION['username']; ?>)</a></li>
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