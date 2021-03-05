<?php

/**
 * Description of system_log
 *
 * @author peng.chen
 * @filename system_log.php 
 * @encoding UTF-8 
 * @datetime 2014-1-9  1:17:33
 * @version 1.0
 * @Description
 */
class system_log_model extends CI_Model
{

    private $_table = "op_system_log";

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function insertData($arg)
    {
        $this->db->insert($this->_table, $arg);
        return $this->db->insert_id();
    }

}

?>