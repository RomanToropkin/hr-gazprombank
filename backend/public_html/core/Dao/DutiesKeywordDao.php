<?php

require_once 'Dao.php';


class DutiesKeywordDao extends Dao
{
    public $table_name = 'duties_keyword';

    public function getTableName()
    {
        return $this->table_name;
    }

    public function getDutiesBySkills($id_skill){
        $sql = "select k.title, k.type
from duties_keyword
         LEFT JOIN skills s on duties_keyword.id_duties = s.id
         LEFT JOIN keyword k on duties_keyword.id_keyword = k.id
         WHERE duties_keyword.id_duties = ?i";
        return $this->db->getAllData($sql, $id_skill);
    }

    public function createDutiesKeyword($id_duty, $keywords){
        try {
            $this->db->query("START TRANSACTION;");
            foreach ($keywords as $keyword) {
                $sql = "INSERT INTO $this->table_name SET id_duties = ?i, id_keyword = ?i;";
                $this->db->query($sql, $id_duty, $keyword);
            }
            $this->db->query("COMMIT;");
            return 0;
        } catch (Exception $ex) {
            $this->db->query("ROLLBACK;");
            return -1;
        }
    }
}