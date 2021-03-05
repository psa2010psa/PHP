<?php
function _json_output($data) { // {{{
	/**
	  json or jsonp outptu
	  */
    $callback=isset($_POST['callback'])?$_POST['callback']:(isset($_GET['callback'])?$_GET['callback']:"");

    $callback=trim($callback);
    if($callback==""){
		header("Content-type: application/json;charset=utf-8");
        echo json_encode($data);
    }else{
		header("Content-type: application/javascript;charset=utf-8");
        echo $callback."(".json_encode($data).")";
    }
} //}}}

