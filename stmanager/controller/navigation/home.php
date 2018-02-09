<?php

class home
{
    var $dbstudent;
    var $dbemployee;
    var $dbcourse;
    var $dbreport;

    function __construct(){
        require_once "../../model/db_student.php";
        require_once "../../model/db_report.php";
        require_once "../../model/db_course.php";
        require_once "../../model/db_employee.php";

        $this->dbstudent = new db_student();
        $this->dbemployee = new db_employee();
        $this->dbcourse = new db_course();
        $this->dbreport = new db_report();
    }

    public function getMainInfo(){
        $student = $this->dbstudent->getAll();
        $employee = $this->dbemployee->getAll();
        $course = $this->dbcourse->getAll();
        $report = $this->dbreport->getAll();

        return array('trainer'=>$employee,'student'=>count($student),'employee'=>count($employee),'course'=>count($course),'report'=>count($report));
    }

    public function getTrainSt(){
        return $this->dbstudent->getAllTrainingInfo();
    }
}
?>