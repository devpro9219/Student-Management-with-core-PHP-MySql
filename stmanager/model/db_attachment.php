<?php

class db_attachment
{
    var $dbcrud;
    var $table;
    var $dbstudent;

    function db_attachment() {
        include_once('db_abstractcrud.php');
        $this->dbcrud = new db_abstractcrud();
        $this->table = 'attachment';
    }

    public function save($atch_url, $msg_id){
        $info_field = array('atch_url', 'msg_id');
        $info_value = array($atch_url, $msg_id);
        return $this->dbcrud->insert($info_field, $info_value, $this->table);
    }

    public function getAll(){
        return $this->dbcrud->getAllElement($this->table);
    }

    public function getById($id){
        return $this->dbcrud->idToFields($this->table,$id);

    }

    public function getByMsg($id){
        $list = $this->dbcrud->getAllElement($this->table,'*','_id',"msg_id = '$id'");
        if(count($list) != 0)
            return $list[0]['atch_url'];
        return '';
    }

    function delete($id){
        $this->dbcrud->deleteRow($this->table,$id);
    }

}