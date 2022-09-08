<?php 
// controllers/searchData.php

session_start();
if(!isset($_SESSION['log'])){
    header("Location: ./home");
}

require_once '../fw/fw.php'; 
require_once '../models/Posts.php'; 
require_once '../views/StdHeader.php'; 
require_once '../views/StdFooter.php'; 
require_once '../views/FormSearchData.php'; 
require_once '../views/ResultSearchData.php'; 

$header = new StdHeader();
$header->render();

if(!$_GET){
    $form = new FormSearchData();
    $form->render();
}else{
    $file = fopen("../log/log.txt", 'a') or die("Error de creación archivo de log");
    if(!isset($_GET['id'])){
        $data = "No se envió correctamente el ID del registro a solicitar.";
        fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " . 
        session_id() . " [endpoint] searchData" . " [Msg] " . "Error #1, no se envió ninguna variable con name 'id' vía GET." ) 
        or die("Error de escritura de archivo de log");
    }else{
        $post = new Posts();

        try{
            $data = $post->getDataById($_GET['id']);
        }
        catch(IsNotDigitException $error){
            $result = new ResultSearchData("Se produjo un error intentando consultar el regístro con 'id' " 
            . $_GET['id'] . " el modelo devuelve: " . $error->getErrorMsg());
            $result->render();
            $footer = new StdFooter();
            $footer->render();

            $file = fopen("../log/log.txt", 'a') or die("Error de creación archivo de log");
            fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " 
            . session_id() . " [endpoint] searchData" . " [Msg] " 
            . "Error #2, se produjo un error intentando consultar el regístro con 'id' " 
            . $_GET['id'] . " el modelo devuelve: " . $error->getErrorMsg()) 
            or die("Error de escritura de archivo de log");
            fclose($file);

            exit();
        }
        catch(QueryErrorException $error){
            $result = new ResultSearchData("Se produjo un error intentando consultar el regístro con 'id' " 
            . $_GET['id'] . " la base devuelve: " . $error->getErrorMsg());
            $result->render();
            $footer = new StdFooter();
            $footer->render();

            $file = fopen("../log/log.txt", 'a') or die("Error de creación archivo de log");
            fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " 
            . session_id() . " [endpoint] searchData" . " [Msg] " 
            . "Error #3, se produjo un error intentando consultar el regístro con 'id' "
            . $_GET['id'] . " la base devuelve: " . $error->getErrorMsg()) 
            or die("Error de escritura de archivo de log");
            fclose($file);

            exit();
        }

        if($data){
            $data = json_encode($data);
            fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " . 
            session_id() . " [endpoint] searchData" . " [Msg] " . "Se realizó con éxito la consulta del regístro con 'id' " . $_GET['id'] . " de la tabla 'post'." ) 
            or die("Error de escritura de archivo de log");
        }else{
            $data = "No se encontró ningún registro con el 'id' " . $_GET['id'] . ".";
            fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " . 
            session_id() . " [endpoint] searchData" . " [Msg] " . "No se encontró ningún registro con el 'id' " . $_GET['id'] . ".") 
            or die("Error de escritura de archivo de log");
        }
    } 
    fclose($file);

    $result = new ResultSearchData($data);
    $result->render();   
}

$footer = new StdFooter();
$footer->render();

?>
