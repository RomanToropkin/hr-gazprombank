<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/DB.php';

abstract class Dao
{

    protected $db;

    /**
     * Dao constructor.
     */
    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public abstract function getTableName();

    public function getById($id){
        $table_name = $this->getTableName();
        $sql = "SELECT * FROM $table_name WHERE id = ?i;";
        return $this->db->getData($sql, $id);
    }

    public function getList(){
        $table_name = $this->getTableName();
        $sql = "SELECT * FROM $table_name;";
        return $this->db->getAllData($sql);
    }
}