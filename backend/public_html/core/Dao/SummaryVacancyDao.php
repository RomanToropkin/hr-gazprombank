<?php

require_once 'Dao.php';

class SummaryVacancyDao extends Dao
{

    public $table_name = 'summary_vacancy';

    public function getTableName()
    {
        return $this->table_name;
    }

    public function getLinks($id_summary, $filter = []){
      $filter_sql = "";
      if ($filter){
        $filter_sql = "and v.id in (?ai)";
      }
        $sql = "select v.*, summary_vacancy.score
from summary_vacancy
         left join vacancy v on summary_vacancy.id_vacancy = v.id
         where score > 0.31 and id_summary = ?i $filter_sql
         order by score desc;";
        return $this->db->getAllData($sql, $id_summary, $filter);
    }
}
