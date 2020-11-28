<?php

require_once 'Dao.php';


class SkillDao extends Dao
{

    public $table_name = 'skills';

    public function getTableName()
    {
        return $this->table_name;
    }

    public function createSkill($text){
        try {
            $this->db->query("START TRANSACTION;");
            $sql = "INSERT INTO $this->table_name SET skill_text = '?s';";
            $this->db->query($sql, $text);
            $id_skill = $this->db->getLastInserted();
            $this->db->query("COMMIT;");
            return $id_skill;
        } catch (Exception $ex) {
            $this->db->query("ROLLBACK;");
            return -1;
        }
    }
}