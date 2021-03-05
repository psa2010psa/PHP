<?php

/**
 * Description of GetIP
 *
 * @author peng.chen
 * @filename GetIP.php 
 * @encoding UTF-8 
 * @datetime 2014-1-9  1:39:42
 * @version 1.0
 * @Description
 */
class GetIP
{

    private $_param = null;

    function __construct()
    {
        ;
    }

    static function getClientIp()
    {
        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");

        else if (getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");

        else if (getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else
            $ip = "Unknow";

        return $ip;
    }

}

?>