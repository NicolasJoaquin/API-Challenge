<?php

// views/ResultSearchData.php
require_once '../fw/fw.php';
class ResultSearchData extends View {
    public $result;
    public function __construct($res){
        $this->result = $res;
    }
}

?>