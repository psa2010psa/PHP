<?php

/**
 * Description of server_model
 *
 * @author peng.chen
 * @filename server_model.php 
 * @encoding UTF-8 
 * @datetime 2014-1-2  18:31:41
 * @version 1.0
 * @Description
 */
class server_model extends CI_Model
{

    private $_table = "op_mt_server";

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function selectDataInId($arg,$field)
    {
        $this->db->where_in("id", $arg);
        $this->db->select($field);
        $qurey = $this->db->get($this->_table);
        return $qurey->result_array();
    }

    function selectData()
    {
        $this->db->select("id,server_name,file_name");
        $qurey = $this->db->get($this->_table);
        return $qurey->result_array();
    }

}

?>