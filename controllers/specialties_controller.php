<?php
  class SpecialtiesController {

    public function index() {
      $specialties = Specialty::all();
      require_once('views/specialties/index.php');
    }

    public function create(){
        if(!isset($_POST['description']))
            require_once('views/specialties/create.php');
        else
            Specialty::create($_POST['description']);
        return call('specialties','index');
    }

    public function remove(){
        if(!isset($_POST['id']))
            return call('specialties','index');
        else
            Specialty::remove($_POST['id']);            
        return call('specialties','index');
    }

    public function update(){
        if(!isset($_POST['updated'])){
            $id = $_POST['id'];
            $description = $_POST['description'];
            require_once('views/specialties/update.php');
        }
        else{
            Specialty::update($_POST['id'],$_POST['description']);
            return call('specialties','index');
        }
    }

  }
?>