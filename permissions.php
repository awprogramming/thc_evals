<?php


function hasPermission($controller,$action){
	$permissions = array('admin' =>	array('pages' => ['home','login','login_error','profile','permission_error','error'],
									  'auth' => ['login','logout'],
                       				  'users' => ['index','create','remove','update_password'],
                       				  'divisions' => ['index','add_evaluator','remove_evaluator'],
                       				  'counselors' => ['index','create','remove','update','add_division','change_division'],
                       				  'evaluations' => ['questions','create_question','remove_question','update_question','options','update_options','level']),
                     'evaluator' =>	array('pages' => ['home','login','login_error','profile','permission_error','error'],
									  'auth' => ['login','logout'],
									  'users' => ['update_password'],
									  'divisions' => ['get_mine'],
									  'evaluations' => ['create','evaluate','save_response','level'])
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