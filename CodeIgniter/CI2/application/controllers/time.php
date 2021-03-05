<?php


class time extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    public function now(){
        echo json_encode(array("now"=>time()));
    }
}

?>