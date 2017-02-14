<?php
  class Response{

    public $evaluation_id;
    public $question;
    public $score;
    public $feedback;
    public $type;

    public function __construct($evaluation_id, $question, $score, $feedback, $type) {
      $this->evaluation_id = $evaluation_id;
      $this->question = $question;
      $this->score = $score;
      $this->feedback = $feedback;
      $this->type = $type;
    }

    public static function create($evaluation_id,$question,$type) {
      $connection = Db::getInstance();
      $query = "INSERT INTO `response` (`evaluation_id`, `question`, `feedback`, `type`) VALUES ('$evaluation_id','$question','','$type')";
      $connection->query($query);
      return new Response($evaluation_id,$question,0,"",$type);
    }

    public static function create_eval_responses($evaluation_id,$type) {
      $connection = Db::getInstance();
      $query = "SELECT * FROM `question` WHERE `type` = 'GC'";
      $result = $connection->query($query);
      $list = [];
      $next_row = $result->fetch_row();

      while($next_row)
      {
        self::create($evaluation_id,$next_row[1],'GC');
        $next_row = $result->fetch_row();
      }

      if($type!="GC"){
        $query = "SELECT * FROM `question` WHERE `type` = '$type'";
        $result = $connection->query($query);
        $list = [];
        $next_row = $result->fetch_row();

        while($next_row)
        {
          self::create($evaluation_id,$next_row[1],$type);
          $next_row = $result->fetch_row();
        }
      }
      return Response::get_eval_responses($evaluation_id);
    }

    public static function get_eval_responses($evaluation_id) {
      
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
      $list['first'] = $next_row[5];
      $list['last'] = $next_row[6];
      $list['num'] =  $next_row[7];
      while($next_row)
      {
        $responses[] = new Response($next_row[0],$next_row[1],$next_row[2],$next_row[3],$next_row[4]);
        $next_row = $result->fetch_row();
      } 
      $list['responses'] = $responses;
      return $list;
    }

    public static function get_specialist_responses($evaluation_id) {
      
      $connection = Db::getInstance();
      $query = "SELECT r.*,c.first,c.last,e.num FROM response AS r 
                INNER JOIN counselor_evaluation AS c_e 
                ON r.evaluation_id = c_e.evaluation_id
                INNER JOIN counselor as c
                ON c_e.counselor_id = c.id
                INNER JOIN evaluation as e
                ON r.evaluation_id = e.id
                where r.evaluation_id='$evaluation_id'
                AND r.type='S'";
      $result = $connection->query($query);
      $responses = [];
      $next_row = $result->fetch_row();
      $list['first'] = $next_row[5];
      $list['last'] = $next_row[6];
      $list['num'] =  $next_row[7];
      while($next_row)
      {
        $responses[] = new Response($next_row[0],$next_row[1],$next_row[2],$next_row[3],$next_row[4]);
        $next_row = $result->fetch_row();
      } 
      $list['responses'] = $responses;
      return $list;
    }
  }
?>