<?php
  class Counselor{
    public $id;
    public $first;
    public $last;
    public $gender;
    public $division;
    public $type;

    public function __construct($id, $first, $last, $gender, $division, $type) {
      $this->id = $id;
      $this->first = $first;
      $this->last = $last;
      $this->gender = $gender;
      $this->division = $division;
      $this->type = $type;
    }

    public static function all() {
      $connection = Db::getInstance();
      $query = "SELECT * FROM `counselor` WHERE division_id is null";
      $result = $connection->query($query);
      $counselors = [];
      $boys = [];
      $girls = [];

      $next_row = $result->fetch_row();
      while($next_row)
      {
        if($next_row[3]=='m')
          $boys[] = new Counselor($next_row[0],$next_row[1],$next_row[2],$next_row[3],null,$next_row[5]);
        else
          $girls[] = new Counselor($next_row[0],$next_row[1],$next_row[2],$next_row[3],null,$next_row[5]);
        $next_row = $result->fetch_row();
      } 

      $query = "SELECT c.id,c.first,c.last,c.gender,c.division_id,d.name,c.type FROM `counselor` as c 
                INNER JOIN `division` as d 
                on c.division_id = d.id";
      $result = $connection->query($query);
      
      $next_row = $result->fetch_row();
      while($next_row)
      {
        if($next_row[3]=='m')
          $boys[] = new Counselor($next_row[0],$next_row[1],$next_row[2],$next_row[3],array($next_row[4],$next_row[5]),$next_row[6]);
        else
          $girls[] = new Counselor($next_row[0],$next_row[1],$next_row[2],$next_row[3],array($next_row[4],$next_row[5]),$next_row[6]);
        $next_row = $result->fetch_row();
      }

      $counselors['boys'] = $boys;
      $counselors['girls'] = $girls;
      return $counselors;
    }

    public static function create($first,$last,$gender,$type){
      $connection = Db::getInstance();
      $query = "INSERT INTO `counselor` (`id`, `first`, `last`, `gender`, `division_id`, `type`) VALUES (NULL, '$first', '$last', '$gender', NULL, '$type')";
      $connection->query($query);
    }

    public static function remove($id){
      $connection = Db::getInstance();
      $query = "DELETE FROM `counselor` WHERE id='$id'";
      $connection->query($query);
    }

    public static function update($id,$first,$last,$gender,$type){
      $connection = Db::getInstance();
      $query = "UPDATE `counselor` SET `first`= '$first', `last`= '$last', `gender`= '$gender', `type`= '$type' WHERE id='$id'";
      $connection->query($query);
    }

    public static function add_division($id,$division_id){
      $connection = Db::getInstance();
      $query = "UPDATE `counselor` SET `division_id`='$division_id' WHERE id='$id'";
      $connection->query($query);
    }

    public static function get_divisions($gender){
      $connection = Db::getInstance();
      $query = "SELECT id,name from division where gender='$gender'";

      $result = $connection->query($query);
      $list = [];
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[] = $next_row;
        $next_row = $result->fetch_row();
      }
      return $list;
    }
  }
?>