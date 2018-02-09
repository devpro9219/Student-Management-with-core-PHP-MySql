<?php

class common
{
    var $dbuser,$dbemployee,$dbstudent;
    function __construct(){
        require_once("../../model/db_employee.php");
        require_once("../../model/db_student.php");

        $this->dbemployee = new db_employee();
        $this->dbstudent = new db_student();
    }
    public function getByEmpId($id){
        return $this->dbemployee->getById($id);
    }

    public function getBySt($id){
        return $this->dbstudent->getById($id);
    }
}