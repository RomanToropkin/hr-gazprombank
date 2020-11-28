<?php

require_once 'Dao.php';

class AutoAnswerDao extends Dao
{

    public $table_name = 'autoanswer';

    public function getTableName()
    {
        return $this->table_name;
    }
}