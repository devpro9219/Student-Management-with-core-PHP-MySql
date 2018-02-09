<?php

class report
{
    var $dbreport;
    var $dbstudent;
    var $myId;
    function __construct(){
        require_once "../../model/db_report.php";
        require_once "../../model/db_student.php";

        $this->dbreport = new db_report();
        $this->dbstudent = new db_student();
    }

    public function getStudent(){
        return $this->dbstudent->getAll();
    }

    public function save_report($stu_id, $rp_title, $rp_url){
      return  $this->dbreport->save($stu_id, $rp_title, $rp_url);
    }

    public function getAllReport(){
        return $this->dbreport->getFullInfo();
    }

    public function getReportById($id){
        return  $this->dbreport->getById($id);
    }

}