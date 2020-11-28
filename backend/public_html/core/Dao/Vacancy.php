<?php

require_once 'Dao.php';

class Vacancy extends Dao
{

  public $table_name = 'vacancy';

  public function getTableName()
  {
    return $this->table_name;
  }

  public function createVacancy($title, $work_start, $work_end, $region, $is_distant, $description)
  {
    try {
      $this->db->query("START TRANSACTION;");
      $sql = "INSERT INTO vacancy (title, work_start, work_end, is_distant, word_description) VALUE ('?s',?i,?i,?i,'?s');";
      $this->db->query($sql, $title, $work_start, $work_end, $is_distant, $description);
      $id = $this->db->getLastInserted();
      $this->db->query("COMMIT;");
      return $id;
    } catch (Exception $ex) {
      $this->db->query("ROLLBACK;");
      return -1;
    }
  }

  public function getListVacancy($offset)
  {
    if ($offset) {
      $offset = 10 * ($offset - 1);
      $sql = "SELECT sql_calc_found_rows vacancy.id, vacancy.title,
                           CASE
                            WHEN work_start > 0 THEN concat(work_start, ' год (лет)')
                            ELSE 'без опыта'
                            END as work_start,
                           is_distant,
                           word_description,
                           c.title as category
                FROM vacancy
                         left join category c on vacancy.id_category = c.id
                where is_deleted = 0 LIMIT ?i OFFSET ?i;";
      $data = $this->db->getAllData($sql, 10, $offset);
      $counts = "SELECT FOUND_ROWS() as count";
      $counts = $this->db->getData($counts)['count'];

      return ['page_count' => ceil($counts / 10), 'data' => $data];
    } else {
      $sql = "SELECT sql_calc_found_rows vacancy.id, vacancy.title,
                           CASE
                            WHEN work_start > 0 THEN concat(work_start, ' год (лет)')
                            ELSE 'без опыта'
                            END as work_start,
                           is_distant,
                           word_description,
                           c.title as category
                FROM vacancy
                         left join category c on vacancy.id_category = c.id
                where is_deleted = 0";
      $data = $this->db->getAllData($sql, 10, $offset);
      return ['data'=>$data];
    }
  }
}
