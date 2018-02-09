<?php

class Training
{
    var $dbtraining;

    function __construct(){
        require_once("../../model/db_course.php");
        require_once("../../model/db_training.php");
        $this->dbcourse = new db_course();
        $this->dbtraining = new db_training();
    }

    public function addTraining($cur_id, $train_name, $train_startdate, $train_enddate, $train_descr){
        $this->dbtraining->save($cur_id, $train_name, $train_startdate, $train_enddate, $train_descr);
    }

    public function updateTraining($train_id, $cur_id, $train_name, $train_startdate, $train_enddate, $train_descr){
        return $this->dbtraining->update($train_id, $cur_id, $train_name, $train_startdate, $train_enddate, $train_descr);
    }

    public function getAllTrainings() {
        return $this->dbtraining->getAll();
    }

    public function getByTrainId($id){
        return $this->dbtraining->getById($id);
    }

    public function getCourseList(){
        return $this->dbcourse->getAll();
    }

    public function deleteTraining($id){
        return   $this->dbtraining->delete($id);
    }
}
