<?php

/**
 * Description of notice_model
 *
 * @author peng.chen
 * @filename notice_model.php 
 * @encoding UTF-8 
 * @datetime 2014-1-10 10:46:19
 * @version 1.0
 * @Description
 */
class m_userlist_model extends CI_Model
{

    private $_table = "op_user";

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function selectUserlistDataCount()
    {
        //$this->db->where("is_delete", 0);
        return $this->db->count_all_results($this->_table);
    }

    function selectUserDataList($num, $offset)
    {
        $this->db->order_by("uid ", "desc");
        //$this->db->where("is_delete", 0);
        $this->db->select("uid,email,password,group_id,app,real_name,mobile,login_ip,last_login_ip,login_time,last_login_time,is_manager,is_lock,is_delete,create_time");
        $qurey = $this->db->get($this->_table, $num, $offset);
        return $qurey->result_array();
    }
/*
    function updateUserlistDataById($id, $arg)
    {
        $this->db->where("id", $id);
        return $this->db->update($this->_table, $arg);
    }

    function insertUserlistData($arg)
    {
        $this->db->insert($this->_table, $arg);
        return $this->db->insert_id();
    }

    function selectUserlistDataByInId($arg)
    {
        $this->db->where_in("id", $arg);
        $this->db->where("is_delete", 0);
        $this->db->select("id,title,content,is_delete,title_color");
        $qurey = $this->db->get($this->_table);
        return $qurey->result_array();
    }

    function selectUserlistDataById($id)
    {
        $this->db->where("id", $id);
        $this->db->select("id,title,content,is_delete,title_color");
        $qurey = $this->db->get($this->_table);
        return $qurey->row_array();
    }
 * 
 */

}

?>