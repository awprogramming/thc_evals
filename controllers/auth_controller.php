<?php
  class AuthController {

    public function login() {
      if (!isset($_POST['username'])||!isset($_POST['password']))
        return call('pages', 'error');
      if ($this->upCheck($_POST['username'],($_POST['password'])))
        echo '<script>window.location = "?controller=pages&action=profile";</script>';
        //return call('pages', 'profile');
      else
        return call('pages','login_error');
    }

    public function logout() {
      session_unset();
      echo '<script>window.location = "?controller=pages&action=login";</script>';
      // return call('pages','login');
    }

    private function upCheck($u,$p) {
      $connection = Db::getInstance();
      $query = "SELECT password,id,role FROM user where username='$u'";
      $result = $connection->query($query);

      if($connection === false) {
          trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connection->error, E_USER_ERROR);
          return false;
      }
      else {
        $r=$result->fetch_row();
        if(md5($_POST['password'])==$r[0])
        {
          $_SESSION['logged_in'] = $r[1];
          $_SESSION['role'] = $r[2];
          $_SESSION['username'] = $u;
          return true;
        }
        return false;
      }

    }
  }
?>