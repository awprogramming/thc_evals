<?php
  class User {
    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
    public $id;
    public $username;
    public $role;

    public function __construct($id, $username, $role) {
      $this->id      = $id;
      $this->username  = $username;
      $this->role = $role;
    }

    
  }
?>