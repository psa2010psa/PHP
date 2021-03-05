<?php

/**
 * Description of main
 *
 * @author peng.chen
 * @filename main.php
 * @encoding UTF-8
 * @datetime 2013-12-28  1:06:50
 * @version 1.0
 * @Description
 */
class main extends MY_Controller
{

    private $_param = null;

    function __construct()
    {
        parent::__construct();
        $this->_userInfo = parent::authLogin();
    }

    function index()
    {
        $this->config->load("app_config");
        $appConfigList = $this->config->item("app_list");
        $this->load->library("session");
        $userLoginInfo = $this->session->all_userdata();
        if (!isset($userLoginInfo["app"]) || !$userLoginInfo["app"])
        {
            $this->load->view("noPermissionView");
        }
        else
        {
        	if (strpos($userLoginInfo["app"], 'all') !== false )
        	{
        		$appArray = array_keys($appConfigList);
        	}
            else
            {
            	$appArray = explode(",", trim($userLoginInfo["app"], ','));
            }
            
            $appInfoArray = array();
            foreach ($appArray as $k => $v)
            {
                $appInfoArray[] = array(
                		"app_version" => $appConfigList[$v]["app_version"],
                		"app_name" => $appConfigList[$v]["app_name"],
                		"path" => $appConfigList[$v]["app_path"],
                		"logo_path"=>$appConfigList[$v]["logo_path"]
                );
            }
            parent::setView("mainView", array("data" => $appInfoArray));
        }
    }

}

?>
