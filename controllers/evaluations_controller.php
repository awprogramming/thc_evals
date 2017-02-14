<?php
  class EvaluationsController {

    public function options() {
        $options = Evaluation::options();
        require_once('views/evaluations/options.php');
        return call('evaluations','questions');
    }

    public function update_options() {
        $options = array('low' => $_POST['low'],
                         'high' => $_POST['high'],
                         'gold' => $_POST['gold'],
                         'silver' => $_POST['silver'],
                         'green' => $_POST['green'],
                         'red' => $_POST['red']);
        Evaluation::update_options($options);
        require_once('views/evaluations/options.php');
        return call('evaluations','questions');
    }

    public function questions() {
        $questions = Question::all();
        $general = array();
        $specialist = array();
        $gl = array();
        foreach ($questions as $question) {
            if($question->type=="GC")
                $general[] = $question;
            else if($question->type=="S")
                $specialist[] = $question;
            else
                $gl[] = $question;
        }
        require_once('views/evaluations/questions.php');
    }

    public function create_question(){
        if(!isset($_POST['content'])||!isset($_POST['type']))
            require_once('views/evaluations/create_question.php');
        else
            Question::create($_POST['content'],$_POST['type']);
        return call('evaluations','questions');
    }

    public function remove_question() {
        if(!isset($_POST['id']))
            return call('pages','error');
        else {
            Question::remove($_POST['id']);
            return call('evaluations','questions');
        }
    }

    public function update_question() {
        $types = ['GC','S','GL'];
        if(!isset($_POST['updated'])){
            $id = $_POST['id'];
            $type = $_POST['type'];
            $content = $_POST['content'];
            require_once('views/evaluations/update_question.php');
        }
        else{
            Question::update($_POST['id'],$_POST['content'],$_POST['type']);
            return call('evaluations','questions');
        }
    }

    public function create(){
        if(!isset($_POST['counselor_id'])||!isset($_POST['num'])||!isset($_POST['type']))
            return call('pages','error');
        else{
            $options = Evaluation::options();
            $evaluation_id = Evaluation::create($_POST['counselor_id'],$_POST['num'],$_POST['type']);
            $responses = Response::create_eval_responses($evaluation_id,$_POST['type']);
            require_once('views/evaluations/evaluate.php');
        }
    }

    public function evaluate(){
        if(!isset($_POST['evaluation_id']))
            return call('pages','error');
        else{
            $options = Evaluation::options();
            $evaluation_id = $_POST['evaluation_id'];
            $type = $_POST['type'];
            $responses = Response::get_eval_responses($_POST['evaluation_id']);
            require_once('views/evaluations/evaluate.php');
        }
    }

    public function specialist(){
        if(!isset($_POST['evaluation_id']))
            return call('pages','error');
        else{
            $options = Evaluation::options();
            $evaluation_id = $_POST['evaluation_id'];
            $type = $_POST['type'];
            $responses = Response::get_specialist_responses($_POST['evaluation_id']);
            require_once('views/evaluations/specialist.php');
        }
    }

    public function save_response(){
        if(!isset($_POST['evaluation_id'])||!isset($_POST['question'])||!isset($_POST['score'])||!isset($_POST['feedback']))
            return call('pages','error');
        else
            Evaluation::save_response($_POST['evaluation_id'],$_POST['question'],$_POST['score'],$_POST['feedback']);
    }

    public function level(){
        if(!isset($_POST['score']))
            return call('pages','error');
        else{
            $level = Evaluation::level($_POST['score']);
            echo $level;
            return $level;
        }
    }

    public function view(){
        if(!isset($_POST['evaluation_id']))
            return call('pages','error');
        else{
            $options = Evaluation::options();
            $evaluation_id = $_POST['evaluation_id'];
            $type = $_POST['evaluation_type'];
            $responses = Response::get_eval_responses($_POST['evaluation_id']);
            require_once('views/evaluations/view.php');
        }
    }

    public function submit(){
        if(!isset($_POST['evaluation_id']))
            return call('pages','error');
        else{
            Evaluation::submit($_POST['evaluation_id']);
            return call('pages','profile');
        }
    }

    public function approve(){
        if(!isset($_POST['evaluation_id']))
            return call('pages','error');
        else{
            Evaluation::approve($_POST['evaluation_id']);
            return call('pages','profile');
        }
    }

  }
?>