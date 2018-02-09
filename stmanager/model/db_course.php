<?php

class db_course
{
    var $dbcrud;
    var $table;

    function db_course() {
        include_once('db_abstractcrud.php');
        require_once(dirname(__FILE__).'../../settings/params.php');
        $this->dbcrud = new db_abstractcrud();
        $this->table = 'course';
    }

    public function save($cur_name, $cur_descr) {
        $info_field = array(COURSE_NAME, COURSE_DESCRIPTION);
        $info_value = array($cur_name, $cur_descr);
        return $this->dbcrud->insert($info_field, $info_value, $this->table);
    }

    public function update($cur_id, $cur_name, $cur_descr){
        $info_field = array(COURSE_NAME, COURSE_DESCRIPTION);
        $info_value = array($cur_name, $cur_descr);
        $this->dbcrud->update($info_field, $info_value, $this->table, $cur_id);
        return true;
    }

    public function getAll(){
       return $this->dbcrud->getAllElement($this->table);
    }

    function getById($id){
        return $this->dbcrud->idToFields($this->table, $id);
    }

    public function delete($id){
        $list = $this->dbcrud->getAllElement('student','*','_id',"cur_id = '$id'");
        if(count($list) != 0)
            return false;
        $list = $this->dbcrud->getAllElement('training','*','_id',"cur_id = '$id'");
        if(count($list) != 0)
            return false;
        $this->dbcrud->deleteRow($this->table, $id);
        return true;
    }
}