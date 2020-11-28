<?php

require_once 'Dao.php';


class EducationDao extends Dao
{

    public $table_name = 'education';

    public function getTableName()
    {
        return $this->table_name;
    }

    public function getEducationBySummary($id_summary){
        $sql = "SELECT * FROM $this->table_name WHERE id_summary = ?i;";
        return $this->db->getAllData($sql, $id_summary);
    }
}