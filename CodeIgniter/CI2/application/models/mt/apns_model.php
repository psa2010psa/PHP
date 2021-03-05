<?php

/**
 * Description of log_model
 *
 * @author peng.chen
 * @filename log_model.php 
 * @encoding UTF-8 
 * @datetime 2014-1-9  1:31:19
 * @version 1.0
 * @Description
 */
class apns_model extends CI_Model
{

    private $_table = "op_mt_push_content";

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function selectData()
    {
        $this->db->select("*");
        $this->db->where("is_delete", 0);
        $qurey = $this->db->get($this->_table);
        return $qurey->result_array();
    }
    
    function getDataList($num, $offset)
    {
        $this->db->where("is_delete", 0);
        $this->db->order_by("id ", "desc");     
        $this->db->select("*");
        $qurey = $this->db->get($this->_table, $num, $offset);
        return $qurey->result_array();
    }
    
    function selectDataById($id)
    {
        $this->db->where("id", $id);
        $this->db->select("*");
        $qurey = $this->db->get($this->_table);
        return $qurey->row_array();
    }
    
    function updateDataById($id,$arg)
    {
        $this->db->where("id", $id);
        return $this->db->update($this->_table, $arg);
    }
    
    function insertData($arg)
    {
        $this->db->insert($this->_table, $arg);
        return $this->db->insert_id();
    }
    
    //获取总记录数
    function getCountData()
    {    
        $this->db->where("is_delete", 0);
        return $this->db->count_all_results($this->_table);
    }
        

}

?>