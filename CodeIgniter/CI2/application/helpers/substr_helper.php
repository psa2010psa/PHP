<?php

/**
 * Description of substr_helper
 *
 * @author peng.chen
 * @filename substr_helper.php 
 * @encoding UTF-8 
 * @datetime 2013-12-30  21:37:02
 * @version 1.0
 * @Description
 */
function utf_substr($str, $len)
{
    for ($i = 0; $i < $len; $i++)
    {
        $temp_str = substr($str, 0, 1);
        if (ord($temp_str) > 127)
        {
            $i++;
            if ($i < $len)
            {
                $new_str[] = substr($str, 0, 3);
                $str = substr($str, 3);
            }
        }
        else
        {
            $new_str[] = substr($str, 0, 1);
            $str = substr($str, 1);
        }
    }
    return join($new_str);
}

?>