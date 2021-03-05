<?php
/**
 * Created by JetBrains PhpStorm.
 * User: peng.chen
 * Date: 14-7-31
 * Time: 下午4:00
 * To change this template use File | Settings | File Templates.
 */
    class redis_model extends CI_Model{
        private $redis;
        function __construct(){
            parent::__construct();
            $this->redis = new Redis();
            $this->redis->connect('127.0.0.1', 6379);
        }
        //插入值
        function redis_Set($key,$value,$expire_time){
            $op_Result=$this->redis->set($key,$value,$expire_time);
            if($op_Result){
                return true;
            }else{
                return false;
            }
        }
        //批量插入值
        function redis_Mset($inc_arr){
            $op_Result=$this->redis->mset($inc_arr);
            if($op_Result){
                return true;
            }else{
                return false;
            }
        }
        //删除值
        function redis_Del($key){
            $op_Result=$this->redis->del($key);
            if($op_Result){
                return true;
            }else{
                return false;
            }
        }
        //获得键名对应的值
        function redis_Get($key){
            $op_Result=$this->redis->get($key);
            if($op_Result){
                return $op_Result;
            }else{
                return false;
            }
        }
    }
?>