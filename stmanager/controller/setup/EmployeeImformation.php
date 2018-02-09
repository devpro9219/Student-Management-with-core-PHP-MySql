<?php

class EmployeeInformation
{
    var $dbemployee;

    function __construct(){
        require_once("../../model/db_employee.php");
        $this->dbemployee = new db_employee();
    }

    public function saveEmployee($emp_name,$emp_surname,$emp_phone,$emp_gender,$emp_birth,$emp_img,$emp_status,$user_name,$user_email,$user_password){
        return $this->dbemployee->saveFullEmployee($emp_name,$emp_surname,$emp_phone,$emp_gender,$emp_birth,$emp_img,$emp_status,$user_name,$user_email,$user_password);
    }

    public function updateEmployee($emp_id,$emp_name,$emp_surname,$emp_phone,$emp_gender,$emp_birth,$emp_img,$emp_status,$user_name,$user_email,$user_password){

        return $this->dbemployee->updateFullEmployee($emp_id,$emp_name,$emp_surname,$emp_phone,$emp_gender,$emp_birth,$emp_img,$emp_status,$user_name,$user_email,$user_password);
    }

    public function getAllEmployee(){
        return $this->dbemployee->getAll();
    }

    public function getByEmpId($id){
        return $this->dbemployee->getById($id);
    }

    public function deleteEmp($id){
       return  $this->dbemployee->deleteFullEmployee($id);
    }
}