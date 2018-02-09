<?php

class enrolltraining
{
    var $dbcourse;
    var $dbstudent;
    var $dbtraining;
    var $dbenrolltraining;

    function __construct(){
        require_once "../../model/db_course.php";
        require_once "../../model/db_student.php";
        require_once "../../model/db_training.php";
        require_once("../../model/db_enrolltraining.php");

        $this->dbcourse = new db_course();
        $this->dbstudent = new db_student();
        $this->dbtraining = new db_training();
        $this->dbenrolltraining = new db_enrolltraining();
    }

    public function saveEnrollTraining($stu_id, $tran_id){
        return $this->dbenrolltraining->save($stu_id, $tran_id);
    }

    public function updateEnrollTraining($enrotran_id, $stu_id, $tran_id){
        return $this->dbenrolltraining->update($enrotran_id, $stu_id, $tran_id);
    }

    public function getCourseList(){
        return $this->dbcourse->getAll();
    }

    public function getStudentList(){
        return $this->dbstudent->getAll();
    }

    public function getStudentListByCourse($course_id) {
        return $this->dbstudent->getByCourse($course_id);
    }

    public function getTrainingListByCourse($course_id) {
        return $this->dbtraining->getByCourse($course_id);
    }

    public function getTrainingList(){
        return $this->dbtraining->getAll();
    }

    public function getByEnrollTrainingId($id){
        return $this->dbenrolltraining->getFullInfoById($id);
    }

    public function getAllEnrollTrainings() {
        return $this->dbenrolltraining->getFullInfo();
    }

    public function deleteEnrollTraining($id){
        return $this->dbenrolltraining->delete($id);
    }
}