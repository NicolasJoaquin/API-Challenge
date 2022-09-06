<?php

// views/ResultGetData.php
require_once '../fw/fw.php';
class ResultGetData extends View {
    public $resultMsg = "";
    public function __construct($res){
        $this->resultMsg = $res;
    }
}

?>