<?php

/**
 * Description of Login
 *
 * @author peng.chen
 * @filename Login.php 
 * @encoding UTF-8 
 * @datetime 2013-12-27  18:51:48
 * @version 1.0
 * @Description
 */
class Login extends MY_Controller
{

    private $_param = null;

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $this->load->library("session");
        $userLoginInfo = $this->session->all_userdata();
        if (isset($userLoginInfo["logged_in"]) && $userLoginInfo["logged_in"] == true)
        {
            header("location:/main");
        }
        $this->load->view("loginView");
    }

    function ajaxLogin()
    {
        $this->load->library("session");
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $authCode = strtolower($this->input->post("authCode"));
        if (!$email || !$this->validEmail($email))
        {
            parent::echoJson(1, array("msg" => "邮箱输入错误！！"));
        }
        if (!$password)
        {
            parent::echoJson(1, array("msg" => "密码输入错误！！"));
        }
        if (!$authCode)
        {
            parent::echoJson(1, array("msg" => "验证码错误！！"));
        }


        $userLoginInfo = $this->session->all_userdata();
        $authCodeServer = $userLoginInfo["operation.authCode"];
        //$authCodeServer = $_SESSION['code'];
        if ($authCode != $authCodeServer)
        {
            parent::echoJson(1, array("msg" => "验证码错误！！"));
        }

        $this->load->model("user_model");
        $userInfo = $this->user_model->selectUserInfoByEmail($email, TRUE);

        if ($userInfo)
        {
            if ($userInfo["is_lock"] == 1 || !$userInfo["mobile"])
            {
                parent::echoJson(1, array("msg" => "该用户被锁定，请联系管理员！"));
            }
            else if ($userInfo["password"] != md5($password))
            {
                parent::echoJson(2, array("msg" => "密码错误！"));
            }
            else
            {
                if (trim($userInfo["game"], ','))
                {
                    if (strpos($userInfo["app"], '40000') === false)
                    {
                        $userInfo["app"].=",40000";
                    }
                }
                if (trim($userInfo["weixin"], ','))
                {
                	if (strpos($userInfo["app"], '30000') === false)
                	{
                		$userInfo["app"].=",30000";
                	}
                }
                
                $this->load->library("session");
                $sessionData = array(
                    'uid' => $userInfo["uid"],
                    'email' => $userInfo["email"],
                    'group_id' => $userInfo["group_id"],
                    'app' => $userInfo["app"],
                    'game' => $userInfo["game"],
                	'weixin' => $userInfo["weixin"],
                    'is_manager' => $userInfo["is_manager"],
                    'real_name' => $userInfo["real_name"],
                    'mobile' => $userInfo["mobile"],
                    'logged_in' => TRUE
                );
                $this->load->library("GetIP");
                $this->session->set_userdata($sessionData);

                $loginInfo["last_login_ip"] = $userInfo["login_ip"];
                $loginInfo["last_login_time"] = $userInfo["login_time"];
                //$loginInfo["login_ip"] = GetIP::getClientIp();
                $loginInfo["login_ip"] = $_SERVER['REMOTE_ADDR'];
                $loginInfo["login_time"] = time();
                $this->user_model->updateData($userInfo["uid"], $loginInfo);
                //$logData = "login|" . GetIP::getClientIp();
                $logData = "login|" . $_SERVER['REMOTE_ADDR'];
                parent::saveSystemLog($logData);
                $this->input->set_cookie("username", $userInfo["email"], time() + 30 * 24 * 60 * 60);
                parent::echoJson(0);
            }
        }
        else
        {
            parent::echoJson(3, array("msg" => "用户不存在！"));
        }
    }

    //退出
    function logout()
    {
        $this->load->library("session");
        $sessionData = array(
            'uid' => "",
            'email' => "",
            'group_id' => "",
            'app' => "",
            'is_manager' => "",
            'real_name' => "",
            'mobile' => "",
            'logged_in' => FALSE
        );
        $this->session->set_userdata($sessionData);
        header("location:/");
    }

    function validEmail($email)
    {
        $isValid = true;
        $atIndex = strrpos($email, "@");
        if (is_bool($atIndex) && !$atIndex)
        {
            $isValid = false;
        }
        else
        {
            $domain = substr($email, $atIndex + 1);
            $local = substr($email, 0, $atIndex);
            $localLen = strlen($local);
            $domainLen = strlen($domain);
            if ($localLen < 1 || $localLen > 64)
            {
                // local part length exceeded
                $isValid = false;
            }
            else if ($domainLen < 1 || $domainLen > 255)
            {
                // domain part length exceeded
                $isValid = false;
            }
            else if ($local[0] == '.' || $local[$localLen - 1] == '.')
            {
                // local part starts or ends with '.'
                $isValid = false;
            }
            else if (preg_match('/\\.\\./', $local))
            {
                // local part has two consecutive dots
                $isValid = false;
            }
            else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
            {
                // character not valid in domain part
                $isValid = false;
            }
            else if (preg_match('/\\.\\./', $domain))
            {
                // domain part has two consecutive dots
                $isValid = false;
            }
            else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local)))
            {
                // character not valid in local part unless 
                // local part is quoted
                if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local)))
                {
                    $isValid = false;
                }
            }
            /*
              if ($isValid && !(checkdnsrr($domain, "MX") || checkdnsrr($domain, "A")))
              {
              // domain not found in DNS
              $isValid = false;
              }
             * 
             */
        }
        return $isValid;
    }

}

?>