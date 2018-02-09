<?php

class assigntrainer
{
    var $dbtraining;
    var $dbemployee;
    var $dbassigntrainer;

    function __construct(){
        require_once "../../model/db_training.php";
        require_once "../../model/db_employee.php";
        require_once "../../model/db_assigntrainer.php";

        $this->dbtraining = new db_training();
        $this->dbemployee = new db_employee();
        $this->dbassigntrainer = new db_assigntrainer();
    }

    public function saveAssignTrainer($tran_id, $emp_id){
        return $this->dbassigntrainer->save($tran_id, $emp_id);
    }

    public function updateAssignTrainer($asstran_id, $tran_id, $emp_id){
        return $this->dbassigntrainer->update($asstran_id, $tran_id, $emp_id);
    }

    public function getTrainingList(){
        return $this->dbtraining->getAll();
    }

    public function getEmployeeList(){
        return $this->dbemployee->getAll();
    }

    public function getByAssignTrainerId($id){
        return $this->dbassigntrainer->getById($id);
    }

    public function getAllAssignTrainers() {
        return $this->dbassigntrainer->getFullInfo();
    }

    public function deleteAssignTrainer($id){
        $this->dbassigntrainer->delete($id);
    }
}