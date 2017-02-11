<?php
  class CounselorsController {

    public function index() {
      $counselors = Counselor::all();
      require_once('views/counselors/index.php');
    }

    public function create(){
        if(!isset($_POST['first'])||!isset($_POST['last'])||!isset($_POST['gender'])||!isset($_POST['type']))
            require_once('views/counselors/create.php');
        else
            Counselor::create($_POST['first'],$_POST['last'],$_POST['gender'],$_POST['type']);
        return call('counselors','index');
    }

    public function remove(){
        if(!isset($_POST['id']))
            return call('counselors','index');
        else
            Counselor::remove($_POST['id']);            
        return call('counselors','index');
    }

    public function update(){
        $types = ['General Counselor','Specialist','Group Leader'];
        if(!isset($_POST['updated'])){
            $id = $_POST['id'];
            $first = $_POST['first'];
            $last = $_POST['last'];
            $gender = $_POST['gender'];
            $type = $_POST['type'];
            require_once('views/counselors/update.php');
        }
        else{
            Counselor::update($_POST['id'],$_POST['first'],$_POST['last'],$_POST['gender'],$_POST['type']);
            return call('counselors','index');
        }
    }

    public function add_division(){
        if(!isset($_POST['division_id'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $divisions = Counselor::get_divisions($gender);
            require_once('views/counselors/add_division.php');
        }
        else{
            Counselor::add_division($_POST['id'],$_POST['division_id']);
            return call('counselors','index');
        }
    }

    public function add_specialty(){
        if(!isset($_POST['specialty_id'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $specialties = Counselor::get_specialties();
            require_once('views/counselors/add_specialty.php');
        }
        else{
            Counselor::add_specialty($_POST['id'],$_POST['specialty_id']);
            return call('counselors','index');
        }
    }

    public function change_division(){
        if(!isset($_POST['changed'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $division_id = $_POST['division_id'];
            $divisions = Counselor::get_divisions($gender);
            require_once('views/counselors/change_division.php');
        }
        else{
            Counselor::add_division($_POST['id'],$_POST['division_id']);
            return call('counselors','index');
        }
    }

    public function change_specialty(){
        if(!isset($_POST['changed'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $specialty_id = $_POST['specialty_id'];
            $specialties = Counselor::get_specialties();
            require_once('views/counselors/change_specialty.php');
        }
        else{
            Counselor::add_specialty($_POST['id'],$_POST['specialty_id']);
            return call('counselors','index');
        }
    }

  }
?>