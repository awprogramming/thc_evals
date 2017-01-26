<?php
    session_start();
    require_once('dbconfig.php');
  	require_once('permissions.php');
    $controller = $_POST['controller'];
    $action = $_POST['action'];
    require_once('routes.php');
?>