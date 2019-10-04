<?php

/**
 * Descripción: Programa Aprender PHP. Ejercicio 12
 *
 * Descripción extensa: update.php gestiona la consulta sql UPDATE y actualiza los datos de la BD.
 *
 * @title: Practica 1: Aprender con PHP
 * @author Adrian Sorribas Segua & Ferran Ramia Tena  ;al361880@uji.es&al361866@uji.es; 
 * @copyright 2019 Adrián & Ferran
 * @license CC-BY-NC-SA
 * @version 1
 */
 
include("./gestionBD.php");
function handler($pdo,$table){
    

    $query = "UPDATE $table SET nombre =?, apellidos =?, email=?,dni=?,clave=? WHERE client_id=?";
    var_dump($query); 
    
    try { 
        $client=array($_REQUEST['userName'],$_REQUEST['apellidos'],$_REQUEST['email'],$_REQUEST['dni'],$_REQUEST['passwd'], $_REQUEST['id']);
        $consult = $pdo->prepare($query);
        $a=$consult->execute($client);
        if (1>$a)echo "InCorrecto";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}

$table = "A_cliente";
var_dump($_POST);
handler( $pdo,$table);

?>