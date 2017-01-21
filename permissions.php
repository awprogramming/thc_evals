<?php


function hasPermission($controller,$action){
	$permissions = array('admin' =>	array('pages' => ['home','login','login_error','profile','permission_error','error'],
									  'auth' => ['login','logout'],
                       				  'users' => ['index','create','remove','update_password']),
                     'evaluator' =>	array('pages' => ['home','login','login_error','profile','permission_error','error'],
									  'auth' => ['login','logout'],
									  'users' => ['update_password'])
                      );
	$question = $permissions[$_SESSION['role']];
	if(array_key_exists($controller, $question)){
		if (in_array($action, $question[$controller]))
			return true;
		else
			return false;
	}
	else
		return false;
}



	

?>