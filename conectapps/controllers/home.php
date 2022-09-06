<?php 
// controllers/index.php

session_start();
$_SESSION['log'] = true;

require_once '../fw/fw.php'; 
require_once '../views/StdHeader.php'; 
require_once '../views/StdFooter.php'; 
require_once '../views/Home.php'; 

$header = new StdHeader();
$header->render();

$home = new Home();
$home->render();

$footer = new StdFooter();
$footer->render();

?>