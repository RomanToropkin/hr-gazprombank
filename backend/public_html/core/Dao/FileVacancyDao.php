<?php

require_once 'Dao.php';

class FileVacancyDao extends Dao
{

    public $table_name = 'vacancy_files';

    public function getTableName()
    {
        return $this->table_name;
    }

    public function getFilesByVacancy($id_vacancy){
        $sql = "select f.path, f.url
                from vacancy_files
                         left join files f on vacancy_files.id_file = f.id
                where id_vacancy = ?i;";
        return $this->db->getAllData($sql, $id_vacancy);
    }
}