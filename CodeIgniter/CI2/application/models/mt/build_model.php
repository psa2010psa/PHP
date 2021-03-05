<?php

/**
 * Description of build_model
 *
 * @author peng.chen
 * @filename build_model.php 
 * @encoding UTF-8 
 * @datetime 2014-1-2  16:32:41
 * @version 1.0
 * @Description
 */
class build_model extends CI_Model
{

    private $_table = "op_mt_build_notice";

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function selectDataById($id)
    {
        $this->db->where("id ", $id);
        $this->db->select("id,notice_id_list,server_id_list,create_time");
        $qurey = $this->db->get($this->_table);
        return $qurey->row_array();
    }

    function selectDataCount()
    {
        $this->db->where("is_model", 0);
        return $this->db->count_all_results($this->_table);
    }

    function selectDataList($num, $offset)
    {
        $this->db->order_by("id ", "desc");
        $this->db->where("is_delete", 0);
        $this->db->where("is_model", 0);
        $this->db->select("id,server_id_list,notice_id_list,send_time,create_time");
        $qurey = $this->db->get($this->_table, $num, $offset);
        return $qurey->result_array();
    }

    function insertData($arg)
    {
        $this->db->insert($this->_table, $arg);
        return $this->db->insert_id();
    }

    function updateData($id, $arg)
    {
        $this->db->where("id", $id);
        return $this->db->update($this->_table, $arg);
    }

    function selectDataByModel($where)
    {
        $this->db->where("is_model", $where);
        $this->db->where("is_delete", 0);
        $this->db->select("*");
        $qurey = $this->db->get($this->_table);
        return $qurey->result_array();
    }
    
    function selectAllData()
    {
        $this->db->select("*");
        $qurey = $this->db->get($this->_table);
        return $qurey->result_array();
    }

}

?>