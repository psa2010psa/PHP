<?php

/**
 * Description of lantern_model
 *
 * @author peng.chen
 * @filename lantern_model.php 
 * @encoding UTF-8 
 * @datetime 2014-7-30 19:40:09
 * @version 1.0
 * @Description
 */
class lantern_model extends CI_Model
{

    private $_table = "op_mt_lantern";

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
    //根据选择区服计算个数
    function getCountByArea($areaId)
    {
        if($areaId >0)
        { 
            $this->db->where("game_server_id", $areaId);
        }
        $this->db->where("is_delete", 0);
        return $this->db->count_all_results($this->_table);
    }
    //根据选择区服查询数据
    function getDataListByArea($areaId,$num, $offset)
    {
        if($areaId >0)
        { 
            $this->db->where("game_server_id", $areaId);
        }
        $this->db->where("is_delete", 0);
        $this->db->order_by("id ", "desc");     
        $this->db->select("*");
        $qurey = $this->db->get($this->_table, $num, $offset);
        return $qurey->result_array();
    }
    //根据条件查询数据
    function selDataByCon($game_server_id,$tv_id)
    {
        $time = time();
        $sql = "SELECT * from {$this->_table} WHERE is_delete = 0 AND game_server_id={$game_server_id} AND game_tv_id={$tv_id} AND (send_start_time is null OR send_start_time + keep_time*60 >{$time} )";//UNIX_TIMESTAMP(NOW())
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    //根据game_server_id查找可以推送的数据
    function selectDataByGid($gid)
    {
        $this->db->select("*");
        $this->db->where("is_delete", 0);
        $this->db->where("game_server_id", $gid);
        $this->db->where("status", 0);
        $qurey = $this->db->get($this->_table);
        return $qurey->result_array();
    }

}

?>