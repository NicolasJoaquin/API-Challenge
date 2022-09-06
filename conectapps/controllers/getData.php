<?php 
// controllers/getData.php

session_start();
if(!isset($_SESSION['log'])){
    header("Location: ./home");
}

require_once '../fw/fw.php'; 
require_once '../models/Posts.php'; 
require_once '../views/StdHeader.php'; 
require_once '../views/StdFooter.php'; 
require_once '../views/FormGetData.php'; 
require_once '../views/ResultGetData.php'; 

$header = new StdHeader();
$header->render();

if(!$_POST){
    $form = new FormGetData();
    $form->render();
}else{
    $post = new Posts();
    if($_POST['deleteTable'] == "yes"){
        try{
            $post->deleteTable(); 
        }
        catch(QueryErrorException $error){
            $result = new ResultGetData("Se produjo un error intentando eliminar los regístros de la tabla 'post',
             la base devuelve el siguiente error: " . $error->getErrorMsg());
            $result->render();
            $footer = new StdFooter();
            $footer->render();

            $file = fopen("../log/log.txt", 'a') or die("Error de creación archivo de log");
            fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " 
            . session_id() . " [endpoint] getData" . " [Msg] " 
            . "Error #1, se produjo un error al eliminar los regístros de la tabla 'post', la base devuelve: " . $error->getErrorMsg()) 
            or die("Error de escritura de archivo de log");
            fclose($file);

            exit();
        }
    }
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://jsonplaceholder.typicode.com/posts");
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    
    $data = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    
    if($err){
        $result = new ResultGetData($err);
        $result->render();

        $file = fopen("../log/log.txt", 'a') or die("Error de creación archivo de log");
        fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " 
        . session_id() . " [endpoint] getData" . " [Msg] " 
        . "Error #2, se produjo el siguiente error al extraer los posts de la API https://jsonplaceholder.typicode.com/posts: " . $err) 
        or die("Error de escritura de archivo de log");
        fclose($file);
    }else{
        $data = json_decode($data);
        
        foreach($data as $value){
            try{
                $post->newPost($value->userId, $value->id, $value->title, $value->body);
            }
            catch(IsNotNumericException $error){
                $result = new ResultGetData("Se produjo un error intentando insertar el regístro con 'id' " 
                . $value->id . " el modelo devuelve: " . $error->getErrorMsg());
                $result->render();
                $footer = new StdFooter();
                $footer->render();

                $file = fopen("../log/log.txt", 'a') or die("Error de creación archivo de log");
                fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " 
                . session_id() . " [endpoint] getData" . " [Msg] " 
                . "Error #3, se produjo un error intentando insertar el regístro con 'id' " 
                . $value->id . " el modelo devuelve: " . $error->getErrorMsg()) 
                or die("Error de escritura de archivo de log");
                fclose($file);

                exit();
            }
            catch(IsNotStringException $error){
                $result = new ResultGetData("Se produjo un error intentando insertar el regístro con 'id' " 
                . $value->id . " el modelo devuelve: " . $error->getErrorMsg());
                $result->render();
                $footer = new StdFooter();
                $footer->render();

                $file = fopen("../log/log.txt", 'a') or die("Error de creación archivo de log");
                fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " 
                . session_id() . " [endpoint] getData" . " [Msg] " 
                . "Error #4, se produjo un error intentando insertar el regístro con 'id' " 
                . $value->id . " el modelo devuelve: " . $error->getErrorMsg()) 
                or die("Error de escritura de archivo de log");
                fclose($file);

                exit();
            }
            catch(QueryErrorException $error){
                $result = new ResultGetData("Se produjo un error intentando insertar el regístro con 'id' " 
                . $value->id . " la base devuelve: " . $error->getErrorMsg());
                $result->render();
                $footer = new StdFooter();
                $footer->render();

                $file = fopen("../log/log.txt", 'a') or die("Error de creación archivo de log");
                fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " 
                . session_id() . " [endpoint] getData" . " [Msg] " 
                . "Error #5, se produjo un error intentando insertar el regístro con 'id' " 
                . $value->id . " la base devuelve: " . $error->getErrorMsg()) 
                or die("Error de escritura de archivo de log");
                fclose($file);

                exit();
            }
        }

        $file = fopen("../log/log.txt", 'a') or die("Error de creación archivo de log");
        fwrite($file, "\n [Fecha] " . date("d/m/Y H:i:s") . " [IP] " . $_SERVER['REMOTE_ADDR'] . " [PHPSESSID] " . 
        session_id() . " [endpoint] getData" . " [Msg] " . "Se dieron de alta con éxito todos los regístros en la tabla 'post'.") 
        or die("Error de escritura de archivo de log");          
        fclose($file);

        $resultMsg = "Se han dado de alta todos los regístros con éxito.";

        $result = new ResultGetData($resultMsg);
        $result->render();
    }
}

$footer = new StdFooter();
$footer->render();

?>
