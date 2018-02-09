<?php

class login
{
    var $dbuser;

    function __construct(){
        require_once("../../model/db_user.php");
        $this->dbuser = new dbo_user();
    }

    public function checkPassword($first,$password){
        $user = null;
        if($user = $this->dbuser->check($first,$password)){
            $_SESSION['userId'] = $user['_id'];
            $_SESSION['userType'] = $user['user_type'];
            $_SESSION['psId'] = $user['ps_id'];
            return true;
        }else{
            return false;
        }
    }
}