<?php
  class Question{

    public $id;
    public $content;
    public $type;

    public function __construct($id, $content, $type) {
      $this->id = $id;
      $this->content = $content;
      $this->type = $type;
    }

    public static function all() {
      $connection = Db::getInstance();
      $query = "SELECT * FROM `question`";
      $result = $connection->query($query);
      $list = [];
      $next_row = $result->fetch_row();

      while($next_row)
      {
        $list[] = new Question($next_row[0],$next_row[1],$next_row[2]);
        $next_row = $result->fetch_row();
      } 
      return $list;
    }

    public static function create($content,$type) {
      $connection = Db::getInstance();
      $query = "INSERT INTO `question` (`id`, `content`, `type`) VALUES (NULL, '$content', '$type')";
      $connection->query($query);
    }

    public static function remove($id) {
      $connection = Db::getInstance();
      $query = "DELETE FROM `question` WHERE id='$id'";
      $connection->query($query);
    }

    public static function update($id,$content,$type){
      $connection = Db::getInstance();
      $query = "UPDATE `question` SET `content`= '$content', `type`='$type' WHERE id='$id'";
      $connection->query($query);
    }
  }
?>