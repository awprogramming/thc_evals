<?php
  session_start();
  require_once('dbconfig.php');

  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    $controller = 'pages';
    $action     = 'profile';
  }

  require_once('views/layout.php');
?>