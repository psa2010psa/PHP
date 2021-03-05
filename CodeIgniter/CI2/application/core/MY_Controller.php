<?php

/**
 * Description of MY_Controller
 *
 * @author peng.chen
 * @filename MY_Controller.php 
 * @encoding UTF-8 
 * @datetime 2013-10-10  18:04:36
 * @version 1.0
 * @Description
 */
class MY_Controller extends CI_Controller
{

    //构造函数：在构造函数中判断用户是否已经登陆，如果登陆，可进入后台控制器，返回跳转到登陆页面  
    public function __construct()
    {
        parent::__construct();
    }

    //登陆检测
    function authLogin()
    {
    	log_message('INFO', '  ');
    	log_message('INFO', ' request url '.serialize($this->uri->uri_string()));
    	log_message('INFO', ' request params '.serialize($_REQUEST));
    	
    	//校验
    	$this->load->library('form_validation');
    	$this->form_validation->set_error_delimiters('', '');
    	
        $this->load->library("session");
        $userLoginInfo = $this->session->all_userdata();
        if (!$userLoginInfo["logged_in"])
        {
            header("location:/login");
        }
        else
        {
            return $userLoginInfo;
        }
    }

    function authManage()
    {
        $this->load->library("session");
        $userLoginInfo = $this->session->all_userdata();
        if ($userLoginInfo["is_manager"] == 0)
        {
            header("location:/main");
        }
        else
        {
            return $userLoginInfo;
        }
    }

    //验证app权限
    function authApp()
    {
        $uri = $_SERVER["REQUEST_URI"];
        $uriArr = explode('/', $uri);
        $path = $uriArr[1];
        //var_dump($path);
        $this->config->load("app_config");
        $appConfigList = $this->config->item("app_list");
        $this->load->library("session");
        $userLoginInfo = $this->session->all_userdata();
        if ($userLoginInfo["app"])
        {
        	if (strpos($userLoginInfo["app"], 'all') !== false )
        	{
        		$appArray = array_keys($appConfigList);
        	}
        	else
        	{
        		$appArray = explode(",", trim($userLoginInfo["app"], ','));
        	}
        	
            if ($appArray)
            {
            	$appInfoArray = array();
                foreach ($appArray as $k => $v)
                {
                    $app_path = $appConfigList[$v]["app_path"];
                    $pathArr = explode('/', $app_path);
                    $appInfoArray[] = $pathArr[1];
                }
                
                //var_dump($appInfoArray);
                if (in_array($path, $appInfoArray))
                {
                    return ;
                }
            }
        }
        
        header("location:/main");
    }
    
    function getParam()
    {
        $param = file_get_contents("php://input");
        $paramArray = json_decode($param, true);
        return $paramArray;
    }

    function echoJson($errorCode, $args = array())
    {
        $echoArray = Array();
        $echoArray["errorCode"] = $errorCode;
        if (count($args) > 0)
        {
            foreach ($args as $k => $v)
            {
                $echoArray[$k] = $v;
            }
        }
        echo json_encode($echoArray);
        exit();
    }

    function echoData($arg)
    {
        echo json_encode($arg);
        exit();
    }

    //渲染HTML
    function setView($template, $data = array())
    {
        $this->load->library("session");
        $userLoginInfo = $this->session->all_userdata();
        $this->load->view("headerView", array("userInfo" => array("email" => $userLoginInfo["email"], "is_manager" => $userLoginInfo["is_manager"], "uid" => $userLoginInfo["uid"], "real_name" => $userLoginInfo["real_name"], "mobile" => $userLoginInfo["mobile"])));

        $this->load->view($template, $data);
        $this->load->view("footerView");
    }

    //保存API日志
    function saveErrorLog($message, $type)
    {
        $fileName = "logs/" . date("Ymd", time()) . "_" . $type . ".log";
        error_log($message, 3, $fileName);
    }

    //保存日志
    function saveSystemLog($action)
    {
        $this->load->model("system_log_model");
        $this->load->library("session");
        $userLoginInfo = $this->session->all_userdata();
        $data["uid"] = $userLoginInfo["uid"];
        $data["action"] = $action;
        $data["create_time"] = time();
        $this->system_log_model->insertData($data);
    }

    function json_encode_cn($arr, $each = false)
    {
        $arr_ = array();

        foreach ($arr as $key => $val)
        {
            if (is_array($val))
            {
                $arr_[$key] = $this->json_encode_cn($val, true);
            }
            else
            {
                $arr_[$key] = $val = urlencode($val);
            }
        }

        if ($each)
        {
            return $arr_;
        }
        return urldecode(json_encode($arr_));
    }

    //保存日志
    function insertGameOpRecord($action, $table, $id, $param = array())
    {
        $arr_record = array();
        $arr_record['action'] = $action;
        $arr_record['table'] = $table;
        $arr_record['id'] = $id;
        $arr_record['param'] = $param;

        $action_str = json_encode($arr_record);


        $this->load->model("game/record_model");
        $this->load->library("session");
        $userLoginInfo = $this->session->all_userdata();
        $data["user_id"] = $userLoginInfo["uid"];
        $data["game_id"] = !empty($param['game_id']) ? $param["game_id"] : '';
        $data["data"] = $action_str;
        $data["create_time"] = time();
        $this->record_model->insertData($data);
    }
    /*
     * 检测用户权限
     * $num CRUD行为 1:查询 2：修改 3：增加 4：删除
     * 返回值： true为允许访问，false为不允许访问
     */
    function authCrud($num)
    {
        $this->load->library("session");
        $userLoginInfo = $this->session->all_userdata();
        
        $this->config->load("app_option/mt_config");
        $app_config = $this->config->item("mt");
        $userCrud = $app_config['user_crud'];
        if($userCrud)
        {
            $userKey = $userLoginInfo["uid"];
            if(isset($userCrud[$userKey]) && is_array($userCrud[$userKey]))
            {
                if(in_array($num, $userCrud[$userKey]))
                {
                    return true;//允许访问
                }
                else
                {
                    return false;//不允许访问
                }
            }
            else
            {
                return true;//没限制
            }
        }
        else
        {
            return true;
        }
    }
    //返回当前用户的权限数组
    function userLimit()
    {
        $this->load->library("session");
        $userLoginInfo = $this->session->all_userdata();
        
        $this->config->load("app_option/mt_config");
        $app_config = $this->config->item("mt");
        $userCrud = $app_config['user_crud'];
        
        $array = array();
        if($userCrud)
        {
            $userKey = $userLoginInfo["uid"];
            if(isset($userCrud[$userKey]) && is_array($userCrud[$userKey]))
            {
                $array = $userCrud[$userKey];
            }
        }
        return $array;
    }

}

?>