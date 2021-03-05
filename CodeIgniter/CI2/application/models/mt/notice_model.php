<?php

/**
 * Description of notice_model
 *
 * @author peng.chen
 * @filename notice_model.php 
 * @encoding UTF-8 
 * @datetime 2013-12-30  21:08:18
 * @version 1.0
 * @Description
 */
class notice_model extends CI_Model
{

    private $_table = "op_mt_notice";

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function selectDataCount()
    {
        $this->db->where("is_delete", 0);
        return $this->db->count_all_results($this->_table);
    }

    function selectDataList($num, $offset)
    {
        $this->db->order_by("id ", "desc");
        $this->db->where("is_delete", 0);
        $this->db->select("id,title,content,is_delete,title_color,create_time");
        $qurey = $this->db->get($this->_table, $num, $offset);
        return $qurey->result_array();
    }

    function updateDataById($id, $arg)
    {
        $this->db->where("id", $id);
        return $this->db->update($this->_table, $arg);
    }

    function insertData($arg)
    {
        $this->db->insert($this->_table, $arg);
        return $this->db->insert_id();
    }

    function selectDataByInId($arg)
    {
        $this->db->where_in("id", $arg);
        $this->db->where("is_delete", 0);
        $this->db->select("id,title,content,is_delete,title_color");
        $qurey = $this->db->get($this->_table);
        return $qurey->result_array();
    }

    function selectDataById($id)
    {
        $this->db->where("id", $id);
        $this->db->select("id,title,content,is_delete,title_color");
        $qurey = $this->db->get($this->_table);
        return $qurey->row_array();
    }
    
    //根据条件查询
    function selectDataListBySearch($num, $offset,$search)
    {
        $sql = "SELECT * from {$this->_table} WHERE is_delete = 0 AND binary title LIKE '%{$search}%' order by id DESC lIMIT {$offset},{$num}";
        $query = $this->db->query($sql);
        return $query->result_array();  
        /*
        $this->db->order_by("id ", "desc");
        $this->db->where("is_delete", 0);
        $this->db->like('binary title', $search);
        $this->db->select("id,title,content,is_delete,title_color,create_time");
        $qurey = $this->db->get($this->_table, $num, $offset);
        return $qurey->result_array();
        */
    }

}

?>