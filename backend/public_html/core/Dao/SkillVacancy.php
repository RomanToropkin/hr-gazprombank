<?php

require_once 'Dao.php';

class SkillVacancy extends Dao
{

    public $table_name = 'skill_vacancy';


    public function getTableName()
    {
        return $this->table_name;
    }

    public function getSkillsByVacancy($id_vacancy){
        $sql = "SELECT s.id, s.skill_text as text
                FROM skill_vacancy
                LEFT JOIN skills s on skill_vacancy.id_skill = s.id
                WHERE id_vacancy = ?i;";
        return  $this->db->getAllData($sql, $id_vacancy);
    }
    
    public function createSkillVacancy($id_vacancy, $id_skill){
        try {
            $this->db->query("START TRANSACTION;");
            $sql = "INSERT INTO $this->table_name SET id_vacancy = ?i, id_skill = ?i;";
            $this->db->query($sql, $id_vacancy, $id_skill);
            $this->db->query("COMMIT;");
            return 0;
        } catch (Exception $ex) {
            $this->db->query("ROLLBACK;");
            return -1;
        }
    }
}