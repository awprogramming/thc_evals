<?php
  class PagesController {

    public function login() {
      require_once('views/pages/login.php');
    }

    public function login_error() {
      $error="Incorrect username or password";
      require_once('views/pages/login.php');
    }

    public function profile() {
      if($_SESSION['role']=='admin')
        require_once('views/pages/profile.php');
      else
        return call('divisions','get_mine');
    }

    public function permission_error() {
      require_once('views/pages/permission_error.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>