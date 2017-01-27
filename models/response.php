<?php
  class Response{

    public $evaluation_id;
    public $question;
    public $score;
    public $feedback;

    public function __construct($evaluation_id, $question, $score, $feedback) {
      $this->evaluation_id = $evaluation_id;
      $this->question = $question;
      $this->score = $score;
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
      $query = "SELECT r.*,c.first,c.last,e.num FROM response AS r 
                INNER JOIN counselor_evaluation AS c_e 
                ON r.evaluation_id = c_e.evaluation_id
                INNER JOIN counselor as c
                ON c_e.counselor_id = c.id
                INNER JOIN evaluation as e
                ON r.evaluation_id = e.id
                where r.evaluation_id='$evaluation_id'";
      $result = $connection->query($query);
      $responses = [];
      $next_row = $result->fetch_row();
      $list['first'] = $next_row[4];
      $list['last'] = $next_row[5];
      $list['num'] =  $next_row[6];
      while($next_row)
      {
        $responses[] = new Response($next_row[0],$next_row[1],$next_row[2],$next_row[3]);
        $next_row = $result->fetch_row();
      } 
      $list['responses'] = $responses;
      return $list;
    }
  }
?>