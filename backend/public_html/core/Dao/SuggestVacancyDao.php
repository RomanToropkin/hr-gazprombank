<?php

require_once 'Dao.php';

class SuggestVacancyDao extends Dao
{

    public $table_name = 'suggest_vacancy';

    public function getTableName()
    {
        return $this->table_name;
    }

    public function getSuggestByVacancy($id_vacancy){
        $sql = "SELECT s.id, s.skill_text as text
                FROM $this->table_name
                LEFT JOIN skills s on $this->table_name.id_suggest = s.id
                WHERE id_vacancy = ?i;";
        return $this->db->getAllData($sql, $id_vacancy);
    }
    public function createSuggestVacancy($id_vacancy, $id_suggest){
        try {
            $this->db->query("START TRANSACTION;");
            $sql = "INSERT INTO $this->table_name SET id_vacancy = ?i, id_suggest = ?i;";
            $this->db->query($sql, $id_vacancy, $id_suggest);
            $this->db->query("COMMIT;");
            return 0;
        } catch (Exception $ex) {
            $this->db->query("ROLLBACK;");
            return -1;
        }
    }

}