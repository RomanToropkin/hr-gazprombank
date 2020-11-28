<?php

require_once 'Dao.php';

class SkillKeywordDao extends Dao
{

    public $table_name = 'skill_keyword';

    public function getTableName()
    {
         return $this->table_name;
    }

    public function getKeywordBySkills($id_skill){
        $sql = "select k.title, k.type
from $this->table_name
         LEFT JOIN skills s on $this->table_name.id_skill = s.id
         LEFT JOIN keyword k on $this->table_name.id_keyword = k.id
         WHERE skill_keyword.id_skill = ?i;";
        return $this->db->getAllData($sql, $id_skill);
    }

    public function createSkillKeyword($id_skill, $keywords){
        try {
            $this->db->query("START TRANSACTION;");
            foreach ($keywords as $keyword) {
                $sql = "INSERT INTO $this->table_name SET id_skill = ?i, id_keyword = ?i;";
                $this->db->query($sql, $id_skill, $keyword);
            }
            $this->db->query("COMMIT;");
            return 0;
        } catch (Exception $ex) {
            $this->db->query("ROLLBACK;");
            return -1;
        }
    }
}