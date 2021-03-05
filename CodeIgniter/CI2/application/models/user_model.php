<?php

/**
 * Description of User_model
 *
 * @author peng.chen
 * @filename User_model.php 
 * @encoding UTF-8 
 * @datetime 2013-10-11  15:59:55
 * @version 1.0
 * @Description
 */
class user_model extends CI_Model
{

    private $_table = "op_user";

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function selectUserInfoByEmail($email, $flag=FALSE)
    {
        $this->db->where("email", $email);
        if ($flag)
        {
            $this->db->where("is_delete", 0);
        }
        $this->db->select("uid,email,password,real_name,mobile,is_lock,group_id,app,login_ip,login_time,is_manager,game,weixin");
        $query = $this->db->get($this->_table, 1);
        return $query->row_array();
    }

    //获取总记录数
    function getCountUser($flag=FALSE)
    {
        $this->db->where("is_delete", 0);
        if ($flag)
        {
            $this->db->where("is_manager", 0);
        }
        return $this->db->count_all_results($this->_table);
    }

    function getUserList($num, $offset, $flag=FALSE)
    {
        $this->db->order_by("uid ", "desc");
        $this->db->where("is_delete", 0);
        if ($flag)
        {
            $this->db->where("is_manager", 0);
        }
        $this->db->select("uid,email,password,group_id,app,real_name,mobile,login_ip,last_login_ip,login_time,last_login_time,is_manager,is_lock,is_delete,create_time");
        $qurey = $this->db->get($this->_table, $num, $offset);
        return $qurey->result_array();
    }

    function setUserInfo($arg)
    {
        $this->db->insert($this->_table, $arg);
        return $this->db->insert_id();
    }

    function getUserInfoByUid($uid)
    {
        $this->db->where("uid", $uid);
        $this->db->select("email,password,mobile,is_lock,group_id");
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }

    function setUserInfoByEmail($email, $arg)
    {
        $this->db->where("email", $email);
        return $this->db->update($this->_table, $arg);
    }

    function updateData($uid, $arg)
    {
        $this->db->where("uid", $uid);
        return $this->db->update($this->_table, $arg);
    }
    
    //获取所有用户的信息
    function selectAllUserInfo()
    {
        $this->db->where("is_delete", 0);
        $this->db->select("uid,email,password,real_name,mobile,is_lock,group_id,app,login_ip,login_time,is_manager");
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }
    
    //根据姓名获取总个数
    function getCountByName($name,$flag=FALSE)
    {
        $this->db->where("is_delete", 0);
        if ($flag)
        {
            $this->db->where("is_manager", 0);
        }
        if($name != "")
        {
            $this->db->like('real_name', $name); 
        }
        return $this->db->count_all_results($this->_table);
    }
    
    //
    function getUserListByName($num, $offset, $name,$flag=FALSE)
    {
        $this->db->order_by("uid ", "desc");
        $this->db->where("is_delete", 0);
        if ($flag)
        {
            $this->db->where("is_manager", 0);
        }
        if($name != "")
        {
            $this->db->like('real_name', $name);
        }
        $this->db->select("uid,email,password,group_id,app,game,weixin,real_name,mobile,login_ip,last_login_ip,login_time,last_login_time,is_manager,is_lock,is_delete,create_time");
        $qurey = $this->db->get($this->_table, $num, $offset);
        return $qurey->result_array();
    }

}

?>