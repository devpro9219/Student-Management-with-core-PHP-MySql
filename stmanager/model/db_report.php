<?php

class db_report
{
    var $dbcrud;
    var $table;
    var $dbstudent;

    function db_report() {
        include_once('db_abstractcrud.php');
        include_once('db_student.php');

        $this->dbcrud = new db_abstractcrud();
        $this->dbstudent = new db_student();
        $this->table = 'report';
    }

    public function save($stu_id, $rp_title, $rp_url){
        $info_field = array('stu_id', 'rp_title', 'rp_url','rp_date');
        $info_value = array($stu_id, $rp_title, $rp_url,date('Y-m-d'));
        return $this->dbcrud->insert($info_field, $info_value, $this->table);
    }

    public function getAll(){
        return $this->dbcrud->getAllElement($this->table);
    }

    public function getFullInfo(){
        $list = $this->getAll();
        for($i=0;$i<count($list);$i++){
            $student = $this->dbstudent->getById($list[$i]['stu_id']);
            $list[$i]['student'] = $student;
        }
        return $list;
    }

    public function getById($id){
        $list = $this->dbcrud->idToFields($this->table,$id);
        $student = $this->dbstudent->getById($list['stu_id']);
        $list['student'] = $student;
        return $list;
    }

    function delete($id){
        $this->dbcrud->deleteRow($this->table,$id);
    }

}