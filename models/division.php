<?php
  class Division {
    public $id;
    public $name;
    public $gender;
    public $evaluators;
    public $counselors;

    public function __construct($id, $name, $gender, $evaluators, $counselors) {
      $this->id = $id;
      $this->name = $name;
      $this->gender = $gender;
      $this->evaluators = $evaluators;
      $this->counselors = $counselors;
    }

    public static function all() {
      $connection = Db::getInstance();
      $query = "SELECT * FROM `division`";
      $result = $connection->query($query);
      $list = [];
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[$next_row[0]] = [$next_row[1],$next_row[2],array(),array()];
        $next_row = $result->fetch_row();
      } 

      $query = "SELECT u.username,u.id,e.division_id from user as u INNER JOIN evaluator as e on e.user_id = u.id";
      $result = $connection->query($query);
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[$next_row[2]][2][] = array($next_row[0],$next_row[1]);
        $next_row = $result->fetch_row();
      }

      $query = "SELECT c.id, d.id from counselor as c INNER JOIN division as d on c.division_id = d.id";
      $result = $connection->query($query);
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[$next_row[1]][3][] = array($next_row[0]);
        $next_row = $result->fetch_row();
      }

      $divisions = [];
      $boys = [];
      $girls = [];
      foreach ($list as $key => $value) {
        if($value[0]=='m')
          $boys[] = new Division($key,$value[1],$value[0],$value[2],$value[3]);
        else
          $girls[] = new Division($key,$value[1],$value[0],$value[2],$value[3]);
      }
      $divisions['boys'] = $boys;
      $divisions['girls'] = $girls;
      return $divisions;
    }

    public static function add_evaluator($division,$evaluator){
      $connection = Db::getInstance();

      $query = "SELECT * FROM `evaluator` WHERE user_id='$evaluator' and division_id='$division'";
      $result = $connection->query($query);

      if(null!==$result->fetch_row())
        return false;      
      else{
        $query = "INSERT INTO `evaluator` (`user_id`, `division_id`) VALUES ('$evaluator','$division')";
      $connection->query($query);
        return true;
      }
    }

    public static function remove_evaluator($evaluator,$division){
      $connection = Db::getInstance();
      $query = "DELETE FROM `evaluator` WHERE user_id='$evaluator' and division_id='$division'";
      $connection->query($query);
    }

    public static function get_evaluators(){
      $connection = Db::getInstance();
      $query = "SELECT id,username from user where role='evaluator'";

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

    public static function get_mine(){
      $connection = Db::getInstance();
      $logged_in = $_SESSION['logged_in'];
      $query = "SELECT c.*,d.name
                FROM counselor AS c
                INNER JOIN evaluator AS e ON c.division_id = e.division_id
                INNER JOIN user AS u ON u.id = e.user_id
                INNER JOIN division AS d on d.id = c.division_id
                WHERE u.id ='$logged_in'";
      
      $result = $connection->query($query);
      $list = [];
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[$next_row[6]][] = new Counselor($next_row[0],$next_row[1],$next_row[2],$next_row[3],$next_row[4],$next_row[5]);
        $next_row = $result->fetch_row();
      }
      
      return $list;

    }


  }
?>