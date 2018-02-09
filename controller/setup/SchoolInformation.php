<?php

class SchoolInformation
{
    var $dborganization;

    function __construct(){
        require_once("../../model/db_school.php");
        $this->db_school = new db_school();
    }
    public function addSchool($org_name, $org_connum, $org_email, $org_address, $org_about, $org_img){
        return $this->db_school->save($org_name, $org_connum, $org_email, $org_address, $org_about, $org_img);
    }

    public function updateSchool($org_id, $org_name, $org_connum, $org_email, $org_address, $org_about, $org_img){
        return $this->db_school->update($org_id, $org_name, $org_connum, $org_email, $org_address, $org_about, $org_img);
    }

    public function getSchool() {
        return $this->db_school->getById(1);
    }
}