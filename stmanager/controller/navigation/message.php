<?php

class message
{
    var $dbmessage;
    var $dbuser;
    var $myId;
    function __construct(){
        require_once "../../model/db_user.php";
        require_once "../../model/db_message.php";

        $this->dbuser = new dbo_user();
        $this->dbmessage = new db_message();
        $this->myId = $_SESSION['userId'];
    }

    public function getUser(){
        $list = $this->dbuser->getAll();
        $result = array();
        for($i=0;$i<count($list);$i++){
            if($list[$i]['_id'] != $this->myId)
                $result[] = $list[$i];
        }
        return $result;
    }

    public function save_message($send,$title,$description,$attachment){

        if(($to = $this->dbuser->getById($send)) && ($from = $this->dbuser->getById($this->myId))){

            $msg_from = $from['_id'];
            $msg_to = $to['_id'];
            $msg_title = $title;
            $msg_note = $description;
            $msg_from_type = $from['user_type'];
            $msg_to_type = $to['user_type'];
            $msg_date = date('Y-m-d H:i:s');


            $this->dbmessage->fullSave($msg_from,$msg_to,$msg_title,$msg_note,$msg_from_type,$msg_to_type,$msg_date,$attachment);
            return true;
        }
        return false;
    }

    public function getReceiverMessage(){
        return $this->dbmessage->getReceiveMessage($this->myId);
    }

    public function getSenderMessage(){
        return $this->dbmessage->getSenderMessage($this->myId);
    }

    public function     getMessageById($id){

        return  $this->dbmessage->getMessageInfo($id);
    }

}