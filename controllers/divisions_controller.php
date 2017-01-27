<?php
  class DivisionsController {

    public function index() {
      $divisions = Division::all();
      require_once('views/divisions/index.php');
    }

    public function add_evaluator(){
        $evaluators = Division::get_evaluators();
        if(!isset($_POST['division_name'])&&!isset($_POST['division_id']))
            return call('divisions','index');
        else if(!isset($_POST['evaluator'])){
            $division_name = $_POST['division_name'];
            $division_id = $_POST['division_id'];
            require_once('views/divisions/add_evaluator.php');
        }
        else{
            if(Division::add_evaluator($_POST['division_id'],$_POST['evaluator']))
                return call('divisions','index');
            else{
                $division_name = $_POST['division_name'];
                $division_id = $_POST['division_id'];
                $error = "The selected evaluator has already been added to this division.";
                require_once('views/divisions/add_evaluator.php');
            }

        }
    }

    public function remove_evaluator(){
        if(!isset($_POST['user_id'])||!isset($_POST['division_id']))
            return call('divisions','index');
        else{
            Division::remove_evaluator($_POST['user_id'],$_POST['division_id']);
            return call('divisions','index');
        }
    }

    public function add_approver(){
        $approvers = Division::get_approvers();
        if(!isset($_POST['division_name'])&&!isset($_POST['division_id']))
            return call('divisions','index');
        else if(!isset($_POST['approver'])){
            $division_name = $_POST['division_name'];
            $division_id = $_POST['division_id'];
            require_once('views/divisions/add_approver.php');
        }
        else{
            if(Division::add_approver($_POST['division_id'],$_POST['approver']))
                return call('divisions','index');
            else{
                $division_name = $_POST['division_name'];
                $division_id = $_POST['division_id'];
                $error = "The selected approver has already been added to this division.";
                require_once('views/divisions/add_approver.php');
            }

        }
    }
    public function remove_approver(){
        if(!isset($_POST['user_id'])||!isset($_POST['division_id']))
            return call('divisions','index');
        else{
            Division::remove_approver($_POST['user_id'],$_POST['division_id']);
            return call('divisions','index');
        }
    }

    public function get_mine(){
        $divisions = Division::get_mine();
        if($_SESSION['role']=='evaluator')
            require_once('views/divisions/mine_evaluator.php');
        else
            require_once('views/divisions/mine_approver.php');
    }

  }
?>