<?php

require_once 'Dao.php';

class DutiesVacancy extends Dao
{

    public $table_name = 'duties_vacancy';

    public function getTableName()
    {
        return $this->table_name;
    }

    public function getDutiesByVacancy($id_vacancy){
        $sql = "SELECT s.id, s.skill_text as text
                FROM duties_vacancy
                LEFT JOIN skills s on duties_vacancy.id_duties = s.id
                WHERE id_vacancy = ?i;";
        return $this->db->getAllData($sql, $id_vacancy);
    }

    public function createDutiesVacancy($id_vacancy, $id_duty){
        try {
            $this->db->query("START TRANSACTION;");
            $sql = "INSERT INTO $this->table_name SET id_vacancy = ?i, id_duties = ?i;";
            $this->db->query($sql, $id_vacancy, $id_duty);
            $this->db->query("COMMIT;");
            return 0;
        } catch (Exception $ex) {
            $this->db->query("ROLLBACK;");
            return -1;
        }
    }
}