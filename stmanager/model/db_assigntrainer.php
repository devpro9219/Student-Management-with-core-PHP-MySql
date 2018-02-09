<?php

class db_assigntrainer
{
    var $dbcrud;
    var $table;
    var $dbtraing;
    var $dbemployee;

    function db_assigntrainer() {
        include_once('db_abstractcrud.php');
        include_once('db_training.php');
        include_once('db_employee.php');
        require_once(dirname(__FILE__).'../../settings/params.php');
        $this->dbcrud = new db_abstractcrud();
        $this->dbtraing = new db_training();
        $this->dbemployee = new db_employee();
        $this->table = 'assign_trainer';
    }

    public function save($tran_id, $emp_id){
        $info_field = array(TRAINING_ID, EMPLOYEE_ID);
        $info_value = array($tran_id, $emp_id);
        $this->dbcrud->insert($info_field, $info_value, $this->table);
    }

    public function update($asstran_id, $tran_id, $emp_id){
        $info_field = array(TRAINING_ID, EMPLOYEE_ID);
        $info_value = array($tran_id, $emp_id);
        $this->dbcrud->update($info_field, $info_value, $this->table, $asstran_id);
        return true;
    }

    public function getFullInfo(){
        $list = $this->getAll();
        $resultArr = array();
        foreach($list as $ass_trainer) {
            $training = $this->dbtraing->getById($ass_trainer[TRAINING_ID]);
            $ass_trainer[TRAINING_NAME] = $training[TRAINING_NAME];
            $ass_trainer[TRAINING_DESCRIPTION] = $training[TRAINING_DESCRIPTION];

            $employee = $this->dbemployee->getById($ass_trainer[EMPLOYEE_ID]);
            $ass_trainer[EMPLOYEE_NAME] = $employee[EMPLOYEE_NAME];
            $resultArr[] = $ass_trainer;
        }

        return $resultArr;
    }

    public function getAll(){
        return $list = $this->dbcrud->getAllElement($this->table);
    }

    public function getById($id){
        return $this->dbcrud->idToFields($this->table, $id);
    }

    public function delete($id){
        $this->dbcrud->deleteRow($this->table, $id);
    }
}