<?php

// views/ViewData.php
require_once '../fw/fw.php';
class ViewData extends View {
    public $data;
    public function __construct($d){
        $this->data = $d;
    }
}

?>