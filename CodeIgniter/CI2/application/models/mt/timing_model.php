<?php

/**
 * Description of notice_model
 *
 * @author peng.chen
 * @filename notice_model.php 
 * @encoding UTF-8 
 * @datetime 2014-3-17 17:47:49
 * @version 1.0
 * @Description
 */
class timing_model extends CI_Model
{

    private $_table = "op_mt_notice_timing";

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
        $this->db->select("*");
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

    function selectDataById($id)
    {
        $this->db->where("id", $id);
        $this->db->select("*");
        $qurey = $this->db->get($this->_table);
        return $qurey->row_array();
    }
    
    function selectAllDataList()
    {       
        $this->db->where("is_delete", 0);
        $this->db->select("*");
        $qurey = $this->db->get($this->_table);
        return $qurey->result_array();
    }
    
    //模糊查找正在定时的公告
    function getTimingIdList($id)
    {
        //select * from op_mt_notice_timing where notice_id_list like "%77%"  and `status` = "0" and is_delete="0";
        $this->db->where("is_delete",0);
        $this->db->where("status",0);
        $this->db->like('notice_id_list', $id);
        $this->db->select("*");
        $qurey = $this->db->get($this->_table);
        return $qurey->result_array();
        
    }

}

?>