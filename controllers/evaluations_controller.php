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
        require_once('views/evaluations/questions.php');
    }

    public function create_question(){
        if(!isset($_POST['content']))
            require_once('views/evaluations/create_question.php');
        else
            Question::create($_POST['content']);
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
        if(!isset($_POST['updated'])){
            $id = $_POST['id'];
            $content = $_POST['content'];
            require_once('views/evaluations/update_question.php');
        }
        else{
            Question::update($_POST['id'],$_POST['content']);
            return call('evaluations','questions');
        }
    }

    public function create(){
        if(!isset($_POST['counselor_id'])||!isset($_POST['num']))
            return call('pages','error');
        else{
            $responses = Evaluation::create($_POST['counselor_id'],$_POST['num']);
            require_once('views/evaluations/evaluate.php');
        }
    }

    public function evaluate(){
        if(!isset($_POST['evaluation_id']))
            return call('pages','error');
        else{
            $responses = Response::get_eval_responses($_POST['evaluation_id']);
            require_once('views/evaluations/evaluate.php');
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
        else
            echo Evaluation::level($_POST['score']);
    }

  }
?>