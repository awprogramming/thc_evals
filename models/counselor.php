<?php
  class Counselor{
    public $id;
    public $first;
    public $last;
    public $gender;
    public $division;
    public $specialty;
    public $type;
    public $evals;

    public function __construct($id, $first, $last, $gender, $division, $specialty, $type) {
      $this->id = $id;
      $this->first = $first;
      $this->last = $last;
      $this->gender = $gender;
      $this->division = $division;
      $this->specialty = $specialty;
      $this->type = $type;
      require_once('models/evaluation.php');
      $this->evals = Evaluation::counselor_evals($id);
    }

    public static function all() {
      $connection = Db::getInstance();
      $query = "SELECT * FROM `counselor` WHERE division_id is null";
      $result = $connection->query($query);
      $list =[];
      $counselors = [];
      $boys = [];
      $girls = [];

      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[$next_row[0]] = [$next_row[1],$next_row[2],$next_row[3],null,null,$next_row[6]];
        $next_row = $result->fetch_row();
      } 

      $query = "SELECT c.id,c.first,c.last,c.gender,c.division_id,d.name,c.type FROM `counselor` as c 
                INNER JOIN `division` as d 
                on c.division_id = d.id";
      $result = $connection->query($query);
      
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[$next_row[0]] = [$next_row[1],$next_row[2],$next_row[3],array($next_row[4],$next_row[5]),null,$next_row[6]];
        $next_row = $result->fetch_row();
      }

      $query = "SELECT c.id,c.specialty_id,specialty.description FROM `counselor` as c 
                INNER JOIN `specialty`
                ON c.specialty_id = specialty.id";

      $result = $connection->query($query);
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[$next_row[0]][4] = array($next_row[1],$next_row[2]);

        $next_row = $result->fetch_row();
      }

      foreach ($list as $key => $value) {
        if($value[2]=='m')
          $boys[] = new Counselor($key,$value[0],$value[1],$value[2],$value[3],$value[4],$value[5]);
        else
          $girls[] = new Counselor($key,$value[0],$value[1],$value[2],$value[3],$value[4],$value[5]);
      }
      
      $counselors['boys'] = $boys;
      $counselors['girls'] = $girls;
      return $counselors;
    }

    public static function create($first,$last,$gender,$type){
      $connection = Db::getInstance();
      $query = "INSERT INTO `counselor` (`id`, `first`, `last`, `gender`, `division_id`, `specialty_id`, `type`) VALUES (NULL, '$first', '$last', '$gender', NULL, NULL, '$type')";
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

    public static function add_specialty($id,$specialty_id){
      $connection = Db::getInstance();
      $query = "UPDATE `counselor` SET `specialty_id`='$specialty_id' WHERE id='$id'";
      $connection->query($query);
    }

    public static function get_specialties(){
      $connection = Db::getInstance();
      $query = "SELECT id,description from specialty";

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