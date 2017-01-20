<?php
  class PagesController {
    public function home() {
      $first_name = 'Jon';
      $last_name  = 'Snow';
      require_once('views/pages/home.php');
    }

    public function login() {
      require_once('views/pages/login.php');
    }

    public function login_error() {
      $error="Incorrect username or password";
      require_once('views/pages/login.php');
    }

    public function profile() {
      require_once('views/pages/profile.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>