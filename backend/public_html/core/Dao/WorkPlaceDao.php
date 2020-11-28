<?php

require_once 'Dao.php';

class WorkPlaceDao extends Dao
{

    public $table_name = 'work_place';

    public function getTableName()
    {
        return $this->table_name;
    }

    public function getWorkPlaceBySummary($id_summary){
        $sql = "SELECT * FROM $this->table_name WHERE id_summary = ?i;";
        return $this->db->getAllData($sql, $id_summary);
    }

}