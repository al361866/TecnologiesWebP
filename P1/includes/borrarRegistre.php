<?php

/**
 * Descripción: Programa Aprender PHP
 *
 * Descripción extensa: borrarRegistre.php gestiona el borrado de un usuario. Ejercicio 11.
 *
 * @title: Practica 1: Aprender con PHP
 * @author Adrian Sorribas Segua & Ferran Ramia Tena  ;al361880@uji.es&al361866@uji.es; 
 * @copyright 2019 Adrián & Ferran
 * @license CC-BY-NC-SA
 * @version 1
 */

include("./gestionBD.php");

try {
    
    $client_id= $_GET["client_id"];
    $table="A_cliente";
    
    borrar($pdo,$table,$client_id);
    
    $a=consultar($pdo,$table);
    if (1>$a) {echo "InCorrecto1";return ;}
    var_dump($a);
    $a=consultar($pdo,$table);
    echo count($a);
    
    if (1>$a) echo "InCorrecto1";
    
 	} catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

?>