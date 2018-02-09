<?php

class Student
{
    var $dbstudent;
    var $dbcourse;
    function __construct(){
        require_once "../../model/db_course.php";
        require_once("../../model/db_student.php");

        $this->dbcourse = new db_course();
        $this->dbstudent = new db_student();
    }

    public function saveStudent($stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_email, $stu_password, $stu_img, $cur_id,  $stu_birth,  $stu_status){
        return $this->dbstudent->saveFullStudent($stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_email, $stu_password, $stu_img, $cur_id,  $stu_birth,  $stu_status);
    }

    public function updateStudent($stu_id,$stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_email, $stu_password, $stu_img, $cur_id,  $stu_birth,  $stu_status){
        return $this->dbstudent->updateFullStudent($stu_id, $stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_email, $stu_password, $stu_img, $cur_id,  $stu_birth,  $stu_status);
    }

    public function getCourseList(){
        return $this->dbcourse->getAll();
    }

    public function getAllStudent(){
        return $this->dbstudent->getAll();
    }

    public function getByStudentId($id){
        return $this->dbstudent->getById($id);
    }

    public function deleteStudent($id){
        return  $this->dbstudent->deleteFullStudent($id);
    }
}