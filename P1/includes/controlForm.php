<?php //control_form.php
    
/**
 * Descripción: Programa Aprender PHP
 *
 * Descripción extensa: Iremos añadiendo cosas complejas en PHP.
 *
 * @title: Practica 1: Aprender con PHP
 * @author Adrian Sorribas Segua & Ferran Ramia Tena  ;al361880@uji.es&al361866@uji.es; 
 * @copyright 2019 Adrián & Ferran
 * @license CC-BY-NC-SA
 * @version 1
 */
     
echo "GET";
var_dump($_GET);
echo "POST";
var_dump($_POST);
echo "REQUEST";
var_dump($_REQUEST);

    if (isset($_REQUEST["nombre"])) {
        $nombre= $_REQUEST["nombre"];
        print ("<P>Hola, $nombre</P>");
    }
 
?>
