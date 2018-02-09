<?php

class Course
{
    var $dbcourse;

    function __construct() {
        require_once('../../model/db_course.php');
        $this->dbcourse = new db_course();
    }

    public function saveCourse($cur_name, $cur_descr) {
        return $this->dbcourse->save($cur_name, $cur_descr);
    }

    public function updateCourse($cur_id, $cur_name, $cur_descr){
        return $this->dbcourse->update($cur_id, $cur_name, $cur_descr);
    }

    public function getAllCourses() {
        return $this->dbcourse->getAll();
    }

    public function getByCourseId($id){
        return $this->dbcourse->getById($id);
    }

    public function deleteCourse($id){
       return $this->dbcourse->delete($id);
    }
}