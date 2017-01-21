<?php
  class User {
    // we define 3 attributes
    // they are public so that we can access them using $post->username directly
    public $id;
    public $username;
    public $role;

    public function __construct($id, $username, $role) {
      $this->id = $id;
      $this->username = $username;
      $this->role = $role;
    }

    public static function all() {
      $connection = Db::getInstance();
      $query = "SELECT id,username,role FROM `user`";
      $result = $connection->query($query);
      $list = [];
      $next_row = $result->fetch_row();

      while($next_row)
      {
        $list[] = new User($next_row[0],$next_row[1],$next_row[2]);

        $next_row = $result->fetch_row();
      } 
      return $list;
    }

    public static function remove($id){
      $connection = Db::getInstance();
      $query = "DELETE FROM `user` WHERE id='$id'";
      $connection->query($query);
    }

    public static function create($username,$password,$role){
      $connection = Db::getInstance();

      $query = "SELECT * FROM user WHERE username='$username'";
      $result = $connection->query($query);

      if(null!==$result->fetch_row())
        return false;      
      else{
        $password = md5($password);
        $query = "INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES (NULL, '$username', '$password', '$role');";
        $connection->query($query);
        return true;
      }
    }

    public static function update_password($password,$id){
      $connection = Db::getInstance();
      $password = md5($password);
      $query = "UPDATE `user` SET `password`= '$password' WHERE id='$id'";
      $connection->query($query);
    }
  }
?>