<?php
  class Specialty{
    public $id;
    public $description;

    public function __construct($id, $description) {
      $this->id = $id;
      $this->description = $description;
    }

    public static function all() {
      $connection = Db::getInstance();
      $query = "SELECT * FROM `specialty`";
      $result = $connection->query($query);
      $specialties = [];
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $specialties[] = new Specialty($next_row[0],$next_row[1]);
        $next_row = $result->fetch_row();
      }
      return $specialties;
    }

    public static function create($description){
      $connection = Db::getInstance();
      $query = "INSERT INTO `specialty` (`id`, `description`) VALUES (NULL, '$description')";
      $connection->query($query);
    }

    public static function remove($id){
      $connection = Db::getInstance();
      $query = "DELETE FROM `specialty` WHERE id='$id'";
      $connection->query($query);
    }

    public static function update($id,$description){
      $connection = Db::getInstance();
      $query = "UPDATE `specialty` SET `description`= '$description' WHERE id='$id'";
      $connection->query($query);
    }
    
  }
?>