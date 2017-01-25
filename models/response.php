<?php
  class Response{

    public $evaluation_id;
    public $question;
    public $grade;
    public $feedback;

    public function __construct($evaluation_id, $question, $grade, $feedback) {
      $this->evaluation_id = $evaluation_id;
      $this->question = $question;
      $this->grade = $grade;
      $this->feedback = $feedback;
    }

    public static function create($evaluation_id,$question) {
      $connection = Db::getInstance();
      $query = "INSERT INTO `response` (`evaluation_id`, `question`, `feedback`) VALUES ('$evaluation_id','$question','')";
      $connection->query($query);
      return new Response($evaluation_id,$question,0,"");
    }

    public static function create_eval_responses($evaluation_id) {
      $connection = Db::getInstance();
      $query = "SELECT * FROM `question`";
      $result = $connection->query($query);
      $list = [];
      $next_row = $result->fetch_row();

      while($next_row)
      {
        $list[] = self::create($evaluation_id,$next_row[1]);
        $next_row = $result->fetch_row();
      } 
      return $list;
    }

    public static function  get_eval_responses($evaluation_id) {
      
      $connection = Db::getInstance();
      $query = "SELECT * FROM `response` where evaluation_id='$evaluation_id'";
      $result = $connection->query($query);
      $list = [];
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $list[] = new Response($next_row[0],$next_row[1],$next_row[2],$next_row[3]);
        $next_row = $result->fetch_row();
      } 
      return $list;
    }
  }
?>