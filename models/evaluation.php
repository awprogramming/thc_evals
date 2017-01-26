<?php
  class Evaluation{

    public $id;
    public $num;
    public $summer;
    public $submitted;
    public $approved;

    public function __construct($id, $num, $summer, $submitted, $approved) {
      $this->id = $id;
      $this->num = $num;
      $this->summer = $summer;
      $this->submitted = $submitted;
      $this->approved = $approved;
    }

    public static function create($counselor_id, $num) {
      $connection = Db::getInstance();
      $query = "INSERT INTO `evaluation` (`num`, `summer`) VALUES ('$num',YEAR(CURDATE()))";
      $connection->query($query);
      $evaluation_id = $connection->insert_id;
      $query = "INSERT INTO `counselor_evaluation` (`counselor_id`,`evaluation_id`) VALUES ('$counselor_id','$evaluation_id')";
      $connection->query($query);
      
      return Response::create_eval_responses($evaluation_id);
    }

    public static function counselor_evals($id) {
      $connection = Db::getInstance();
      $query = "SELECT e.* FROM evaluation AS e
                INNER JOIN counselor_evaluation AS c_e 
                ON c_e.evaluation_id = e.id 
                WHERE counselor_id='$id'";
      $result = $connection->query($query);
      $list = [];
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[] = new Evaluation($next_row[0],$next_row[1],$next_row[2],$next_row[3],$next_row[4]);
        $next_row = $result->fetch_row();
      }
      return $list;
    }

    public static function save_response($evaluation_id,$question,$score,$feedback){
      $connection = Db::getInstance();
      $query = "UPDATE `response` SET `score`= '$score', `feedback`= '$feedback' WHERE evaluation_id='$evaluation_id' AND question='$question'";
      $connection->query($query);
    }

    public static function level($score){
      $connection = Db::getInstance();
      $query = "SELECT * FROM `evaluation_options` WHERE value <= $score AND opt != 'low' AND opt != 'high' ORDER BY value DESC";
      $result = $connection->query($query);
      $first_row = $result->fetch_row();
      return $first_row[0];
    }

    public static function options(){
      $connection = Db::getInstance();
      $query = "SELECT * FROM evaluation_options";
      $result = $connection->query($query);
      $list = [];
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[$next_row[0]] = $next_row[1];
        $next_row = $result->fetch_row();
      }
      return $list;
    }

    public static function update_options($options) {
      $connection = Db::getInstance();
      foreach($options as $option => $value){
        $query = "UPDATE `evaluation_options` SET value= '$value' WHERE opt='$option'";
        $connection->query($query);
      }
    }

  }
?>