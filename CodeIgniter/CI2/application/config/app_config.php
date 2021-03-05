<?php

/**
 * Description of app_config
 *
 * @author peng.chen
 * @filename app_config.php 
 * @encoding UTF-8 
 * @datetime 2013-12-28  2:32:52
 * @version 1.0
 * @Description
 */
$config["app_list"] = array(
    10000 => array(
        "app_name" => "MT",
        "app_path" => "/mt/main",
        "app_alias" => "mt",
        "app_version" => "综",
        "logo_path" => "/resource/app/mt/logo.jpg",
        "noticeServerKey" => "locojoy5463",
        "push_server" => "http://xxx/pushApns.php",
        "check_url" => "http://xxx/cache/cache.php",
        "notice_url" => "http://xxxNotice/html/mt/"
    ),
);

?>