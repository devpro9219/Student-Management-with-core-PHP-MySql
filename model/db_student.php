<?php

class db_student
{
    var $dbcrud;
    var $dbuser;
    var $table;
    var $dbcourse;
    var $userType; //user Table Type from this table

    function db_student()
    {
        include_once('db_abstractcrud.php');
        include_once('db_user.php');
        include_once('db_course.php');
        require_once(dirname(__FILE__).'/../settings/params.php');
        $this->dbcrud = new db_abstractcrud();
        $this->dbuser = new dbo_user();
        $this->dbcourse = new db_course();
        $this->userType = STUDENT_TYPE;
        $this->table = 'student';
    }

    public function save($stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_img, $cur_id, $stu_birth,  $stu_status){
        $info_field = array(STUDENT_SURNAME, STUDENT_NAME, STUDENT_CONNUM, STUDENT_GENDER, STUDENT_IMG, STUDENT_CUR_ID,  STUDENT_BIRTH,  STUDENT_STATUS);
        $info_value = array($stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_img, $cur_id, $stu_birth, $stu_status);
        return $this->dbcrud->insert($info_field, $info_value, $this->table);
    }

    public function saveFullStudent($stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_email, $stu_password, $stu_img, $cur_id,  $stu_birth,  $stu_status){
        $stu_id = $this->save($stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_img, $cur_id,  $stu_birth,  $stu_status);
        return $this->dbuser->save($stu_id, $this->userType, $stu_name, $stu_email, $stu_password);
    }

    public function updateFullStudent($stu_id, $stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_email, $stu_password, $stu_img, $cur_id, $stu_birth, $stu_status){
        $this->update($stu_id, $stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_img, $cur_id, $stu_birth, $stu_status);
        $this->dbuser->updateByStu($stu_id, $this->userType, $stu_name, $stu_email, $stu_password);
        return true;
    }

    public function update($stu_id,$stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_img, $cur_id, $stu_birth,  $stu_status){
        $info_field = array(STUDENT_SURNAME, STUDENT_NAME, STUDENT_CONNUM, STUDENT_GENDER, STUDENT_IMG, STUDENT_CUR_ID,  STUDENT_BIRTH,  STUDENT_STATUS);
        $info_value = array($stu_surname, $stu_name, $stu_connum, $stu_gender, $stu_img, $cur_id, $stu_birth, $stu_status);
        $this->dbcrud->update($info_field, $info_value, $this->table, $stu_id);
        return true;
    }

    public function getAll(){
        $list = $this->dbcrud->getAllElement($this->table);
        $psList = $this->dbuser->parseListByType('ps_id',$this->userType);
        $resultArr = array();
        for($i=0;$i<count($list);$i++){
            if(!isset($psList[$list[$i]['_id']]))
                continue;
            $course = $this->dbcourse->getById($list[$i][STUDENT_CUR_ID]);
            $ps = $psList[$list[$i]['_id']];
            $list[$i]['user_id'] = $ps['user_name'];
            $list[$i]['user_email'] = $ps['user_email'];
            $list[$i]['user_password'] = $ps['user_password'];
            $list[$i]['course_name'] = $course['cur_name'];
            $resultArr[] = $list[$i];
        }

        return $resultArr;
    }

    function getAllTrainingInfo(){
        $query = "SELECT student.stu_name,student.stu_surname,course.cur_name,training.tran_name,DATE(training.tran_startdate) as startDate,DATE(training.tran_enddate) as endDate,employee.emp_name,employee.emp_surname
                    FROM enroll_training
                    INNER JOIN training ON training._id = enroll_training.tran_id
                    INNER JOIN student ON student._id = enroll_training.stu_id
                    INNER JOIN course ON course._id = student.cur_id
                    INNER JOIN assign_trainer ON assign_trainer.tran_id = training._id
                    INNER JOIN employee ON employee._id = assign_trainer.emp_id
                    ";
        return $this->dbcrud->run($query);
    }

    function getById($id){
        $now = $ps = $course = array();
        if(!$now = $this->dbcrud->idToFields($this->table,$id))
            return false;

        if(!$ps = $this->dbuser->getByPs($now['_id'],$this->userType))
            return false;
        if(!$course = $this->dbcourse->getById($now['cur_id']))
            return false;
        $now['user_name'] = $ps['user_name'];
        $now['user_email'] = $ps['user_email'];
        $now['user_password'] = $ps['user_password'];
        $now['course_name'] = $course['cur_name'];
        return $now;
    }

    public function getByCourse($course_id){
        $where = COURSE_ID." = '$course_id'";
        return $this->dbcrud->getAllElement($this->table, '*' , '_id', $where);
    }

    public function delete($id){
        $list = $this->dbcrud->getAllElement('enroll_training','*','_id',"stu_id = '$id'");
        if(count($list) != 0)
            return false;
        $this->dbcrud->deleteRow($this->table,$id);
        return true;
    }

    public function deleteFullStudent($id){

        if($this->delete($id)){
            $this->dbuser->deleteBySt($id);
            return true;
        }
        return false;
    }
}