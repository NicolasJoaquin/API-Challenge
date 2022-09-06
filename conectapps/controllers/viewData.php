<?php 
// controllers/viewData.php

session_start();
if(!isset($_SESSION['log'])){
    header("Location: ./home");
}

require_once '../fw/fw.php'; 
require_once '../models/Posts.php'; 
require_once '../views/StdHeader.php'; 
require_once '../views/StdFooter.php'; 
require_once '../views/ViewData.php'; 

$header = new StdHeader();
$header->render();

$post = new Posts();

try {
    $data = $post->getAll();
} 
catch (QueryErrorException $error) {
    $data = "Se produjo un error al recuperar los regístros de la tabla 'post' la base devuelve: " . $error->getErrorMsg() . ".";
    $v = new ViewData($data);
    $v->render();
    $footer = new StdFooter();
    $footer->render();

    $file = fopen("../log/log.txt", 'a') or die("Error de creación archivo de log");
    fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " 
    . session_id() . " [endpoint] viewData" . " [Msg] " 
    . "Error #1, se produjo un error al recuperar los regístros de la tabla 'post', la base devuelve: " . $error->getErrorMsg()) 
    or die("Error de escritura de archivo de log");
    fclose($file);

    exit();
}

$file = fopen("../log/log.txt", 'a') or die("Error de creación archivo de log");
if($data){
    fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " 
    . session_id() . " [endpoint] viewData" . " [Msg] " . "Se realizó con éxito la consulta de todos los regístros de la tabla 'post', se consultaron " 
    . count($data) . " regístros") 
    or die("Error de escritura de archivo de log");
}else{
    fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " 
    . session_id() . " [endpoint] viewData" . " [Msg] " . "Se realizó con éxito la consulta a la tabla 'post' pero no existen regístros en la misma." ) 
    or die("Error de escritura de archivo de log");
}
fclose($file);

$data = json_encode($data);

$v = new ViewData($data);
$v->render();

$footer = new StdFooter();
$footer->render();

?>
