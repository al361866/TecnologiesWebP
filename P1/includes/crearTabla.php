<?php

/**
 * Descripción: Programa Aprender PHP
 *
 * Descripción extensa: crearTabla.php crea una tabla que contendrá la información de los usuarios.
 *
 * @title: Practica 1: Aprender con PHP
 * @author Adrian Sorribas Segua & Ferran Ramia Tena  ;al361880@uji.es&al361866@uji.es; 
 * @copyright 2019 Adrián & Ferran
 * @license CC-BY-NC-SA
 * @version 1
 */

include("./gestionBD.php");

try {
    
    $table="A_cliente";
    creatablaUsuarios($pdo,$table);
    insertar($pdo,$table,'user3');
    
    $a=consultar($pdo,$table);
    if (1>$a) {echo "InCorrecto1";return ;}
    var_dump($a);
    
    borrar($pdo,$table,$a[count($a)-1]['client_id']);
    $a=consultar($pdo,$table);
    echo count($a);
    
    if (1>$a) echo "InCorrecto1";
    
 	} catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

 ?>