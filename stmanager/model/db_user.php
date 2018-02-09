<?php

class dbo_user
{
    var $dbcrud;
    var $table;
    var $stType;
    function dbo_user()
    {
        include_once('db_abstractcrud.php');
        $this->dbcrud = new db_abstractcrud();
        $this->table = 'user';
        $this->stType = 1;
    }

    public function check($first,$password){
        $list = $this->getAll();

        foreach($list as $now){
            if($password == $now['user_password'] && ($first == $now['user_name'] || $first == $now['user_email'])){
                return $now;
            }
        }
        return false;
    }

    public function save($ps_id,$user_type,$user_name,$user_email,$user_password){
        $info_field = array('ps_id','user_type','user_name','user_email','user_password');
        $info_value = array($ps_id,$user_type,$user_name,$user_email,$user_password);
        return $this->dbcrud->insert($info_field,$info_value,$this->table);
    }

    public function updateByEmp($ps_id,$user_type,$user_name,$user_email,$user_password){
        $info_field = array('user_name','user_email','user_password');
        $info_value = array($user_name,$user_email,$user_password);
        return $this->dbcrud->updateWhere($info_field,$info_value,$this->table,"ps_id='$ps_id' and user_type != '$this->stType'");
    }

    public function updateByStu($ps_id,$user_type,$user_name,$user_email,$user_password){
        $info_field = array('user_name','user_email','user_password');
        $info_value = array($user_name,$user_email,$user_password);
        return $this->dbcrud->updateWhere($info_field,$info_value,$this->table,"ps_id='$ps_id' and user_type = '$this->stType'");
    }

    public function parseListByType($key = '_id',$userType = 2,$equal=true){
        $list = $this->getAllByType($userType,$equal);
        $resultArr = array();
        for($i=0;$i<count($list);$i++){
            $resultArr[$list[$i][$key]] = $list[$i];
        }
        return $resultArr;
    }

    public function delete($id){
        $this->dbcrud->deleteRow($this->table,$id);
    }

    public function deleteByPs($id){
        $where = "ps_id = '$id' and user_type = 0";
        $this->dbcrud->deletewhere($this->table,$where);
    }

    public function deleteBySt($id){
        $where = "ps_id = '$id' and user_type = 1";
        $this->dbcrud->deletewhere($this->table,$where);
    }
    public function getByPs($ps_id,$type = false){
        $where = '';
        if($type) {
            $where = "ps_id = '$ps_id' and user_type = '$type'";
        }else{
            $where = "ps_id = '$ps_id'";
        }

        $list = $this->dbcrud->getAllElement($this->table,'*','_id',$where);

        if(count($list) >0)
            return $list[0];
        return false;
    }

    public function getById($id){
        return $this->dbcrud->idToFields($this->table,$id);
    }

    public function getAllByType($type,$equal=true){
        $where = '';
        if($type && $equal) {
            $where = "user_type = '$type'";
        }elseif($type && !$equal){
            $where = "user_type != '$type'";
        }
        return $this->dbcrud->getAllElement($this->table,'*','_id',$where);
    }

    public function getAll(){
        return  $this->dbcrud->getAllElement('user');
    }
}
?>