<?php

// models/Posts.php
require_once '../fw/fw.php';
require_once '../exceptions/QueryErrorException.php';
require_once '../exceptions/IsNotDigitException.php';
require_once '../exceptions/IsNotNumericException.php';
require_once '../exceptions/IsNotStringException.php';

class Posts extends Model {

    public function getAll(){
        $this->db->query("SELECT *
                            FROM post");
        $errno = $this->db->getErrorNo();
        if($errno !== 0) throw new QueryErrorException($this->db->getError()); 
        return $this->db->fetchAll();
    }

    public function getDataById($id){
        if(!ctype_digit($id)) throw new IsNotDigitException('La cadena de caracteres de la variable $id no es numérica'); 
        $this->db->query("SELECT *
                            FROM post
                            WHERE id = '$id'");
        $errno = $this->db->getErrorNo();
        if($errno !== 0) throw new QueryErrorException($this->db->getError());
        return $this->db->fetch();
    }

    public function newPost($userId, $id, $title, $body){
        if(!is_numeric($userId)) throw new IsNotNumericException('La variable $userId no es un número'); 

        if(!is_numeric($id)) throw new IsNotNumericException('La variable $id no es un número'); 
        
        if(!is_string($title)) throw new IsNotStringException('La variable $title no es un string'); 
        $title = $this->db->escape($title);

        if(!is_string($body)) throw new IsNotStringException('La variable $body no es un string');
        $body = $this->db->escape($body);

        //QUERY INSERT
        $this->db->query("INSERT INTO post (userId, id, title, body) 
                            VALUES ($userId, $id, '$title', '$body')");

        //VERIFICACIÓN DE LA QUERY Y RETORNO
        $errno = $this->db->getErrorNo();
        if($errno !== 0) throw new QueryErrorException($this->db->getError());  
        return true;
    }

    public function deleteTable(){
        $this->db->query("DELETE FROM post");
        $errno = $this->db->getErrorNo();
        if($errno !== 0) throw new QueryErrorException($this->db->getError());  
        return true;
    }

}