<?php

class db_training
{
    var $dbcrud;
    var $table;

    function db_training() {
        include_once('db_abstractcrud.php');
        include_once('db_course.php');
        require_once(dirname(__FILE__).'../../settings/params.php');
        $this->dbcrud = new db_abstractcrud();
        $this->dbcourse = new db_course();
        $this->table = 'training';
    }

    public function save($cur_id, $train_name, $train_startdate, $train_enddate, $train_descr) {
        $info_field = array(COURSE_ID, TRAINING_NAME, TRAINING_STARTDATE, TRAINING_ENDDATE, TRAINING_DESCRIPTION);
        $info_value = array($cur_id, $train_name, $train_startdate, $train_enddate, $train_descr);
        $this->dbcrud->insert($info_field, $info_value, $this->table);
    }

    public function update($train_id, $cur_id, $train_name, $train_startdate, $train_enddate, $train_descr){
        $info_field = array(COURSE_ID, TRAINING_NAME, TRAINING_STARTDATE, TRAINING_ENDDATE, TRAINING_DESCRIPTION);
        $info_value = array($cur_id, $train_name, $train_startdate, $train_enddate, $train_descr);
        $this->dbcrud->update($info_field, $info_value, $this->table, $train_id);
        return true;
    }

    public function getAll() {
        $list = $this->dbcrud->getAllElement($this->table);
        $resultArr = array();
        foreach($list as $training) {
            $course = $this->dbcourse->getById($training[COURSE_ID]);
            $training[COURSE_NAME] = $course[COURSE_NAME];
            $resultArr[] = $training;
        }

        return $resultArr;
    }

    public function getById($id){
        $now = array();
        if(!$now = $this->dbcrud->idToFields($this->table, $id))
            return false;
        return $now;
    }

    public function getByCourse($course_id){
        $where = COURSE_ID." = '$course_id'";
        return $this->dbcrud->getAllElement($this->table, '*' , '_id', $where);
    }

    public function delete($id) {
        $list = $this->dbcrud->getAllElement('enroll_training','*','_id',"tran_id = '$id'");
        if(count($list) != 0)
            return false;
        $list = $this->dbcrud->getAllElement('assign_trainer','*','_id',"tran_id = '$id'");
        if(count($list) != 0)
            return false;
        $this->dbcrud->deleteRow($this->table, $id);
        return true;
    }
}
