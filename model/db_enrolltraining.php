<?php

class db_enrolltraining
{
    var $dbcrud;
    var $table;
    var $dbcourse;
    var $dbsubject;
    var $dbsection;


    function db_enrolltraining() {
        include_once('db_abstractcrud.php');
        include_once('db_course.php');
        include_once('db_student.php');
        include_once('db_training.php');

        $this->dbcrud = new db_abstractcrud();
        $this->dbcourse = new db_course();
        $this->dbstudent = new db_student();
        $this->dbtraining = new db_training();
        $this->table = 'enroll_training';
    }

    public function save($stu_id, $tran_id){
        $info_field = array(STUDENT_ID, TRAINING_ID);
        $info_value = array($stu_id, $tran_id);
        $this->dbcrud->insert($info_field, $info_value, $this->table);
        return true;
    }

    public function update($enrotran_id, $stu_id, $tran_id){
        $info_field = array(STUDENT_ID, TRAINING_ID);
        $info_value = array($stu_id, $tran_id);
        $this->dbcrud->update($info_field, $info_value, $this->table, $enrotran_id);
        return true;
    }

    public function getFullInfo(){
        $list = $this->getAll();
        $resultArr = array();
        foreach($list as $enroll_training) {
            $student = $this->dbstudent->getById($enroll_training[STUDENT_ID]);
            $enroll_training[STUDENT_NAME] = $student[STUDENT_NAME];

            $training = $this->dbtraining->getById($enroll_training[TRAINING_ID]);
            $enroll_training[TRAINING_NAME] = $training[TRAINING_NAME];

            $course = $this->dbcourse->getById($student[COURSE_ID]);
            $enroll_training[COURSE_ID] = $course[ID];
            $enroll_training[COURSE_NAME] = $course[COURSE_NAME];
            $resultArr[] = $enroll_training;
        }

        return $resultArr;
    }

    public function getAll(){
        return $this->dbcrud->getAllElement($this->table);
    }

    public function getFullInfoById($id){
        $list = $this->getById($id);
        $student = $this->dbstudent->getById($list[STUDENT_ID]);
        $list[COURSE_ID] = $student[COURSE_ID];

        return $list;
    }

    public function getById($id){
        return $this->dbcrud->idToFields($this->table, $id);
    }

    public function delete($id){
        $this->dbcrud->deleteRow($this->table, $id);
        return true;
    }
}