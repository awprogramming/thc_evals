<?php
  class UsersController {

    public function index() {
      $users = User::all();
      require_once('views/users/index.php');
    }

    public function create() {
    	if(!isset($_POST['username'])||!isset($_POST['password'])||!isset($_POST['role']))
    		require_once('views/users/create.php');
    	else{
    		if(!User::create($_POST['username'],$_POST['password'],$_POST['role'])){
				$error = "Username already taken.";
    			require_once('views/users/create.php');
    		}
    	}
    	return call('users','index');
    }

    public function remove() {
      if(!isset($_POST['id']))
      	return call('pages','error');
      else {
        User::remove($_POST['id']);
        return call('users','index');
 	  }
    }

    public function update_password(){
    	if(isset($_GET['nav'])){
    		$username = $_SESSION['username'];
    		$id = $_SESSION['logged_in'];
    		require_once('views/users/update_password.php');
    	}
    	else if(!isset($_POST['password'])){
    		$username = $_POST['username'];
    		$id = $_POST['id'];
    		require_once('views/users/update_password.php');
    	}
    	else{
    		User::update_password($_POST['password'],$_POST['id']);
    		if($_SESSION['role']=='evaluator')
    			return call('pages','profile');
    	}
    	if($_SESSION['role']=='admin')
    		return call('users','index');
    }
  }
?>