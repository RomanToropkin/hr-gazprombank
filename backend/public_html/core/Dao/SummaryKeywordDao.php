<?php

require_once 'Dao.php';


class SummaryKeywordDao extends Dao
{

    public $table_name = 'summary_keyword';

    public function getTableName()
    {
        return $this->table_name;
    }

    public function getKeywordsBySummary($id_summary){
        $sql = "select k.*
                from summary_keyword
                LEFT JOIN keyword k on summary_keyword.id_keyword = k.id
                where id_summary = ?i;";
        return $this->db->getAllData($sql, $id_summary);
    }
}