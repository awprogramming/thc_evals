<?php
  function call($controller, $action) {
    if(!isset($_SESSION['logged_in'])){
      if($controller!='auth'&&$controller!='pages'){
        require_once('controllers/pages_controller.php');
        $controller = 'pages';
      }
      else
        require_once('controllers/' . $controller . '_controller.php');
      
      if($action!='login'&&$action!='login_error')
        $action = 'login';
    }
    else
      // require the file that matches the controller name
      require_once('controllers/' . $controller . '_controller.php');
    // create a new instance of the needed controller
    switch($controller) {
      case 'pages':
        $controller = new PagesController();
        break;
      case 'auth':
        $controller = new AuthController();
        break;
    }
    // call the action
    $controller->{ $action }();
  }

  // just a list of the controllers we have and their actions
  // we consider those "allowed" values
  $controllers = array('pages' => ['home','login','login_error','profile','error'],
                       'auth' => ['login','logout']
                      );
  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>