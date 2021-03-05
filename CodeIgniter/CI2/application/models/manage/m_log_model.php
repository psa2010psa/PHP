<?php

/**
 * Description of log_model
 *
 * @author peng.chen
 * @filename m_log_model.php 
 * @encoding UTF-8 
 * @datetime 2014-1-10 17:17:16
 * @version 1.0
 * @Description
 */
class m_log_model extends CI_Model
{

    private $_table = "op_user_log";

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