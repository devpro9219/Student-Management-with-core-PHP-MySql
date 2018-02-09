<?php

class db_school
{
    var $dbcrud;
    var $table;

    function db_school() {
        include_once('db_abstractcrud.php');
        require_once(dirname(__FILE__).'/../settings/params.php');
        $this->dbcrud = new db_abstractcrud();
        $this->table = 'organization';
    }

    public function save($org_name, $org_connum, $org_email, $org_address, $org_about, $org_img) {
        $info_field = array(ORGANIZATION_NAME, ORGANIZATION_CONNUM, ORGANIZATION_EMAIL, ORGANIZATION_ADDRESS, ORGANIZATION_ABOUT, ORGANIZATION_LOGO);
        $info_value = array($org_name, $org_connum, $org_email, $org_address, $org_about, $org_img);
        $this->dbcrud->insert($info_field, $info_value, $this->table);
        return true;
    }

    public function update($org_id, $org_name, $org_connum, $org_email, $org_address, $org_about, $org_img){
        $info_field = array(ORGANIZATION_NAME, ORGANIZATION_CONNUM, ORGANIZATION_EMAIL, ORGANIZATION_ADDRESS, ORGANIZATION_ABOUT, ORGANIZATION_LOGO);
        $info_value = array($org_name, $org_connum, $org_email, $org_address, $org_about, $org_img);
        $this->dbcrud->update($info_field, $info_value, $this->table, $org_id);
        return true;
    }

    function getById($id){
        $now = array();
        if(!$now = $this->dbcrud->idToFields($this->table, $id))
            return false;
        return $now;
    }
}