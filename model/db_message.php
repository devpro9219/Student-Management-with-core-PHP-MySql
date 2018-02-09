<?php

class db_message
{
    var $dbcrud;
    var $dbuser;
    var $table;
    var $userType;
    var $dbstudent;
    var $dbemployee;
    var $dbattachment;

    function db_message()
    {
        require_once "db_abstractcrud.php";
        require_once "db_user.php";
        require_once "db_student.php";
        require_once "db_employee.php";
        require_once "db_attachment.php";

        $this->dbcrud = new db_abstractcrud();
        $this->dbuser = new dbo_user();
        $this->dbstudent = new db_student();
        $this->dbemployee = new db_employee();
        $this->dbattachment = new db_attachment();
        $this->table = 'message';
        $this->userType = 1;
    }

    function save($msg_from,$msg_to,$msg_title,$msg_note,$msg_from_type,$msg_to_type,$msg_date){

        $info_field = array('msg_from','msg_to','msg_title','msg_note','msg_from_type','msg_to_type','msg_date');
        $info_value = array($msg_from,$msg_to,$msg_title,$msg_note,$msg_from_type,$msg_to_type,$msg_date);
        return $this->dbcrud->insert($info_field,$info_value,$this->table);
    }

    public function fullSave($msg_from,$msg_to,$msg_title,$msg_note,$msg_from_type,$msg_to_type,$msg_date,$attachment){
        $id = $this->save($msg_from,$msg_to,$msg_title,$msg_note,$msg_from_type,$msg_to_type,$msg_date);
        if($attachment != '')
            $id = $this->dbattachment->save($attachment,$id);
        return $id;
    }
    public function getById($id){
        return $this->dbcrud->idToFields($this->table,$id);
    }

    public function getMessageInfo($id){
        $message = $this->getById($id);
        $attachment = $this->dbattachment->getByMsg($message['_id']);
        $from = $this->dbuser->getById($message['msg_from']);
        $to = $this->dbuser->getById($message['msg_to']);
        $message['from_email'] = $from['user_email'];
        $message['to_email'] = $to['user_email'];
        $message['attachment'] = $attachment;
        return $message;
    }

    public function getReceiveMessage($user_id){
        $where = "msg_to = '$user_id'";
        $list = $this->dbcrud->getAllElement($this->table,'*','msg_date',$where);
        for($i=0;$i<count($list);$i++){
            $now = $list[$i];
            $list[$i]['attachment'] = $this->dbattachment->getByMsg($now['_id']);
            if($now['msg_from_type'] == 1){
               $user = $this->dbuser->getById($now['msg_from']);
               $ps = $this->dbstudent->getById($user['ps_id']);
               $list[$i]['ps_name'] = $ps['stu_name'].' '.$ps['stu_surname'];
            }else{
                $user = $this->dbuser->getById($now['msg_from']);
                $ps = $this->dbemployee->getById($user['ps_id']);
                $list[$i]['ps_name'] = $ps['emp_name'].' '.$ps['emp_surname'];
            }
        }
        return $list;
    }

    public function getSenderMessage($user_id){
        $where = "msg_from = '$user_id'";
        $list = $this->dbcrud->getAllElement($this->table,'*','msg_date',$where);
        for($i=0;$i<count($list);$i++){
            $now = $list[$i];
            $list[$i]['attachment'] = $this->dbattachment->getByMsg($now['_id']);
            if($now['msg_to_type'] == 1){
                $user = $this->dbuser->getById($now['msg_to']);
                $ps = $this->dbstudent->getById($user['ps_id']);
                $list[$i]['ps_name'] = $ps['stu_name'].' '.$ps['stu_surname'];
            }else{
                $user = $this->dbuser->getById($now['msg_to']);
                $ps = $this->dbemployee->getById($user['ps_id']);
                $list[$i]['ps_name'] = $ps['emp_name'].' '.$ps['emp_surname'];
            }
        }
        return $list;
    }

}