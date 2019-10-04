<?php

/**
 * Descripción: Programa Aprender PHP
 *
 * Descripción extensa: Registrar.php gestiona la consulta para insertar un nuevo cliente. Guarda, prepara y ejecuta la
 * sentencia sql.
 * 
 * @title: Practica 1: Aprender con PHP
 * @author Adrian Sorribas Segua & Ferran Ramia Tena  ;al361880@uji.es&al361866@uji.es; 
 * @copyright 2019 Adrián & Ferran
 * @license CC-BY-NC-SA
 * @version 1
 */
     
include("./gestionBD.php");

function handler($pdo,$table){
    
    $datos = $_REQUEST;
    if (count($_REQUEST) < 6) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }
    $query = "INSERT INTO     $table (nombre, apellidos, email,dni, clave, foto_file)
                        VALUES (?,?,?,?,?,?)";
                       
    echo $query;
    try { 
        $a=array($_REQUEST['userName'], $_REQUEST['surName'], $_REQUEST['email'],$_REQUEST['dni'], $_REQUEST['passwd'], $_REQUEST['foto_file'] );
        print_r ($a);
        $consult = $pdo->prepare($query);
        $a=$consult->execute(array($_REQUEST['userName'], $_REQUEST['surName'], $_REQUEST['email'],$_REQUEST['dni'], $_REQUEST['passwd'], $_REQUEST['foto_file'] ));
        if (1>$a)echo "InCorrecto";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}

$table = "A_cliente";
var_dump($_POST);
handler( $pdo,$table);
?>