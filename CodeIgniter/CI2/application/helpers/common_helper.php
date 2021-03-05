<?php

/**
 * 将日期格式根据以下规律修改为不同显示样式
 * 小于1分钟 则显示多少秒前
 * 小于1小时，显示多少分钟前
 * 一天内，显示多少小时前
 * 3天内，显示前天22:23或昨天:12:23。
 * 超过3天，则显示完整日期。
 * @static
 * @param  $sorce_date 数据源日期 unix时间戳
 * @return void
 */
function getDateStyle($dur_time)
{
	switch(true)
	{
		//一分钟
		case $dur_time < 60 :
			$timeHtml = $dur_time .'秒';
			break;

			//小时
		case $dur_time < 3600 :
			$timeHtml = floor($dur_time/60) . '分钟';
			break;

			//天
		case $dur_time < 86400:
			$timeHtml = floor($dur_time/3600) . '小时';
			break;

		default:
			$timeHtml = date('Y-m-d H:i',$dur_time + time());
			break;

	}
	return $timeHtml;
}

function getIntervalDateStyle($interval_time)
{
	if (!$interval_time)
	{
		$timeHtml = '';
	}
	//一分钟
	elseif ($interval_time < 60)
	{
		$timeHtml = $interval_time .'秒';
	}
	elseif ($interval_time < 3600)
	{
		$timeHtml = floor($interval_time/60) . '分钟';
		$timeHtml .= getIntervalDateStyle($interval_time%60);
	}
	elseif ($interval_time < 86400)
	{
		$timeHtml = floor($interval_time/3600) . '小时';
		$timeHtml .= getIntervalDateStyle($interval_time%3600);
		$timeHtml .= getIntervalDateStyle($interval_time%60);
	}
	else
	{
		$timeHtml = floor($interval_time/86400) . '天';
		$timeHtml .= getIntervalDateStyle($interval_time%86400);
		$timeHtml .= getIntervalDateStyle($interval_time%3600);
		$timeHtml .= getIntervalDateStyle($interval_time%60);
	}
	return $timeHtml;
}

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

//根据键值查询数组数据
function selectArrayByKey($whereKeyArray, $dataArray)
{
    //$whereKeyArray = array("server_name"=>"aaa,"aaaa"=>"bbb");
    foreach ($whereKeyArray as $k => $v)
    {
        
    }
    $newArray = array();
    $i = 0;
    foreach ($dataArray as $d_k => $d_v)
    {
        $key = $whereKeyArray[0];
        $val = $whereKeyArray[1];
        if ($d_v[$key] == $val)
        {
            $newArray[$i] = $d_v;
            $i++;
        }
    }
    return $newArray;
}

//根据id字符串查询数组数据
function selectArrayByIdStr($idStr, $arr)
{
    $tempArr = array();
    $i = 0;
    foreach ($arr as $a_k => $a_v)
    {
        $idArr = explode(",", $idStr);
        foreach ($idArr as $i_k => $i_v)
        {
            if ($a_v["id"] == $i_v)
            {
                $tempArr[$i] = $a_v;
                $i++;
            }
        }
    }
    return $tempArr;
}

?>