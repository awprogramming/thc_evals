<?php
  class Division {
    public $id;
    public $name;
    public $gender;
    public $evaluators;
    public $counselors;
    public $approvers;

    public function __construct($id, $name, $gender, $evaluators, $approvers, $counselors) {
      $this->id = $id;
      $this->name = $name;
      $this->gender = $gender;
      $this->evaluators = $evaluators;
      $this->approvers = $approvers;
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
        $list[$next_row[0]] = [$next_row[1],$next_row[2],array(),array(),array()];
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

      $query = "SELECT u.username,u.id,a.division_id from user as u INNER JOIN approver as a on a.user_id = u.id";
      $result = $connection->query($query);
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[$next_row[2]][3][] = array($next_row[0],$next_row[1]);
        $next_row = $result->fetch_row();
      }

      $query = "SELECT c.id, d.id from counselor as c INNER JOIN division as d on c.division_id = d.id";
      $result = $connection->query($query);
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[$next_row[1]][4][] = array($next_row[0]);
        $next_row = $result->fetch_row();
      }

      $divisions = [];
      $boys = [];
      $girls = [];
      foreach ($list as $key => $value) {
        if($value[0]=='m')
          $boys[] = new Division($key,$value[1],$value[0],$value[2],$value[3],$value[4]);
        else
          $girls[] = new Division($key,$value[1],$value[0],$value[2],$value[3],$value[4]);
      }
      $divisions['boys'] = $boys;
      $divisions['girls'] = $girls;
      return $divisions;
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

     public static function add_approver($division,$approver){
      $connection = Db::getInstance();

      $query = "SELECT * FROM `approver` WHERE user_id='$approver' and division_id='$division'";
      $result = $connection->query($query);

      if(null!==$result->fetch_row())
        return false;      
      else{
        $query = "INSERT INTO `approver` (`user_id`, `division_id`) VALUES ('$approver','$division')";
        $connection->query($query);
        return true;
      }
    }

    public static function remove_approver($approver,$division){
      $connection = Db::getInstance();
      $query = "DELETE FROM `approver` WHERE user_id='$approver' and division_id='$division'";
      $connection->query($query);
    }

    public static function get_approvers(){
      $connection = Db::getInstance();
      $query = "SELECT id,username from user where role='approver'";

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
      if($_SESSION['role']=='admin'){
        $query = "SELECT c.*,d.name,d.id
                  FROM counselor AS c
                  INNER JOIN division AS d on d.id = c.division_id
                  ORDER BY d.id ASC";
      }
      else if($_SESSION['role']=='evaluator'){
        $query = "SELECT c.*,d.name
                  FROM counselor AS c
                  INNER JOIN evaluator AS e ON c.division_id = e.division_id
                  INNER JOIN user AS u ON u.id = e.user_id
                  INNER JOIN division AS d on d.id = c.division_id
                  WHERE u.id ='$logged_in'";
      }
      else if($_SESSION['role']=='office'){
        $query = "SELECT c.*,s.description
                  FROM counselor AS c
                  INNER JOIN specialty AS s ON s.id = c.specialty_id";
      }
      else{
        $query = "SELECT c.*,d.name
                  FROM counselor AS c
                  INNER JOIN approver AS a ON c.division_id = a.division_id
                  INNER JOIN user AS u ON u.id = a.user_id
                  INNER JOIN division AS d on d.id = c.division_id
                  WHERE u.id ='$logged_in'";
      }
      $result = $connection->query($query);
      $list = [];
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[$next_row[7]][] = new Counselor($next_row[0],$next_row[1],$next_row[2],$next_row[3],$next_row[4],$next_row[5],$next_row[6]);
        $next_row = $result->fetch_row();
      }
      return $list;
    }
  }
?>