<?php

require_once 'Dao.php';

class KeywordDao extends Dao
{

    public function getTableName()
    {
        return 'keyword';
    }

    public function findKeyword($query){
        $sql = "select *
from keyword where title like '?s%'
limit 5;";
        return $this->db->getAllData($sql, $query);
    }
}