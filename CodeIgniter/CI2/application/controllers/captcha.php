<?php

/**
 * Description of captcha
 *
 * @author peng.chen
 * @filename captcha.php 
 * @encoding UTF-8 
 * @datetime 2013-12-27  21:25:15
 * @version 1.0
 * @Description
 */
class captcha extends MY_Controller
{

    private $_param = null;

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        //session_start();
        $this->load->library("session");
        $this->load->library('Authcode');
        $authCode = new Authcode();
        $checkCode = $authCode->make_rand(4);
        //$_SESSION['code'] = strtolower($checkCode); 
        $this->session->set_userdata(array("operation.authCode" => strtolower($checkCode)));
        $authCode->show($checkCode);
    }

}

?>