<?php

require_once 'Dao.php';

class SummaryDao extends Dao
{

    public function getTableName()
    {
        return 'summary';
    }

    public function getById($id)
    {
        $sql = "select concat_ws('', smr.l_name, smr.f_name, smr.l_name) as full_name,
       smr.experience,
       smr.phone,
       smr.title,
       smr.description,
       smr.status,
       r.title,
       smr.gender,
       smr.type,
       smr.age,
       smr.link
        from summary smr
            LEFT JOIN region r on smr.id_region = r.id
        where smr.id = ?i;";
        return $this->db->getData($sql, $id);
    }

    public function getList($offset = 1, $filter = [], $status = [])
    {
        $offset = 10 * ($offset-1);
        $filter_sql = "";
        $status_sql = "";
        $filter_sql_1 = "";
        if ($filter){
            $filter_sql = "and id_vacancy in (?ai)";
            $filter_sql_1 = "and sv.id_vacancy in (?ai)";
        }
        if ($status){
            $status_sql = "and smr.status in (?ai)";
        }
        $sql = "select smr.id, concat_ws('', smr.l_name, smr.f_name, smr.l_name) as full_name,
       smr.experience,
       smr.phone,
       smr.title,
       smr.description,
       smr.status,
       r.title as region,
       smr.gender,
       smr.type,
       smr.age,
       smr.link
        from summary smr
            LEFT JOIN region r on smr.id_region = r.id
            JOIN summary_vacancy sv on sv.id_summary = smr.id
            WHERE score > 0.31 $status_sql $filter_sql_1
            order by score desc LIMIT 10 OFFSET ?i;";
        if ($status && $filter){
            $data =  $this->db->getAllData($sql, $status, $filter, $offset);
        } elseif ($status){
            $data =  $this->db->getAllData($sql, $status, $offset);
        } elseif ($filter){
            $data =  $this->db->getAllData($sql, $filter, $offset);
        } else {
            $data =  $this->db->getAllData($sql, $offset);
        }

        $sql = "select count(id_summary) as count
from summary_vacancy
LEFT JOIN summary smr on smr.id = summary_vacancy.id_summary
where score > 0.31 $filter_sql $status_sql
group by id_vacancy;";
      if ($status && $filter){
        $count = $this->db->getAllData($sql, $filter, $status);
      } elseif ($status){
        $count = $this->db->getAllData($sql,$status);
      } elseif ($filter){
        $count = $this->db->getAllData($sql, $filter);
      } else {
        $count = $this->db->getAllData($sql);
      }

        return ['data'=>$data, 'page_count' => ceil(min($count)['count'] / 10)];
    }

    public function changeStatus($id_summary, $status){
        try {
            $this->db->query("START TRANSACTION;");
            $this->db->query("UPDATE summary SET status = ?i WHERE id = ?i;", $status, $id_summary);
            $this->db->query("COMMIT;");
            return 0;
        } catch (Exception $ex) {
            $this->db->query("ROLLBACK;");
            return -1;
        }
    }

}
