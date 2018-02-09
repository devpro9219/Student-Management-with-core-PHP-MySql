<?php

class db_employee
{
    var $dbcrud;
    var $dbuser;
    var $table;
    var $userType;//user Table Type from this table

    function db_employee()
    {
        include_once('db_abstractcrud.php');
        include_once('db_user.php');
        $this->dbcrud = new db_abstractcrud();
        $this->dbuser = new dbo_user();
        $this->table = 'employee';
        $this->userType = 0;
    }

    function getAll(){
        $list = $this->dbcrud->getAllElement($this->table);
        $psList = $this->dbuser->parseListByType('ps_id',$this->userType);
        $resultArr = array();
        for($i=0;$i<count($list);$i++){
            if(!isset($psList[$list[$i]['_id']]))
                continue;
            $ps = $psList[$list[$i]['_id']];
            $list[$i]['user_id'] = $ps['user_name'];
            $list[$i]['user_email'] = $ps['user_email'];
            $list[$i]['user_password'] = $ps['user_password'];
            $resultArr[] = $list[$i];
        }

        return $resultArr;
    }

    function getById($id){
        $now = $ps = array();
        if(!$now = $this->dbcrud->idToFields($this->table,$id))
            return false;

        if(!$ps = $this->dbuser->getByPs($now['_id'],$this->userType))
            return false;

        $now['user_name'] = $ps['user_name'];
        $now['user_email'] = $ps['user_email'];
        $now['user_password'] = $ps['user_password'];
        return $now;
    }

    function save($emp_name,$emp_surname,$emp_connum,$emp_gender,$emp_birth,$emp_img,$emp_status){
        $info_field = array('emp_name','emp_surname','emp_connum','emp_gender','emp_birth','emp_img','emp_status');
        $info_value = array($emp_name,$emp_surname,$emp_connum,$emp_gender,$emp_birth,$emp_img,$emp_status);
        return $this->dbcrud->insert($info_field,$info_value,$this->table);
    }

    function saveFullEmployee($emp_name,$emp_surname,$emp_connum,$emp_gender,$emp_birth,$emp_img,$emp_status,$user_name,$user_email,$user_password){
        $emp_id = $this->save($emp_name,$emp_surname,$emp_connum,$emp_gender,$emp_birth,$emp_img,$emp_status);
        $user_type = $this->userType;
        return $this->dbuser->save($emp_id,$user_type,$user_name,$user_email,$user_password);
    }

    function updateFullEmployee($emp_id,$emp_name,$emp_surname,$emp_connum,$emp_gender,$emp_birth,$emp_img,$emp_status,$user_name,$user_email,$user_password){
        $this->update($emp_id,$emp_name,$emp_surname,$emp_connum,$emp_gender,$emp_birth,$emp_img,$emp_status);
        $user_type = $this->userType;

        $this->dbuser->updateByEmp($emp_id,$user_type,$user_name,$user_email,$user_password);
        return true;
    }

    function update($emp_id,$emp_name,$emp_surname,$emp_connum,$emp_gender,$emp_birth,$emp_img,$emp_status){
        $info_field = array('emp_name','emp_surname','emp_connum','emp_gender','emp_birth','emp_img','emp_status');
        $info_value = array($emp_name,$emp_surname,$emp_connum,$emp_gender,$emp_birth,$emp_img,$emp_status);
        $this->dbcrud->update($info_field,$info_value,$this->table,$emp_id);
        return true;
    }

    function delete($id){
        $list = $this->dbcrud->getAllElement('assign_trainer','*','_id',"emp_id = '$id'");
        if(count($list) != 0)
            return false;
        $this->dbcrud->deleteRow($this->table,$id);
        return true;
    }

    function deleteFullEmployee($id){
        if($this->delete($id)){
            $this->dbuser->deleteByPs($id);
            return true;
        }
        return false;

    }
}