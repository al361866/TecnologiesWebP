<?php

/**
 * Descripción: Programa Aprender PHP
 *
 * Descripción extensa: portal0.php se encarga de la gestión del pie de página, cabezera y la navbar.
 *
 * @title: Practica 1: Aprender con PHP
 * @author Adrian Sorribas Segua & Ferran Ramia Tena  ;al361880@uji.es&al361866@uji.es; 
 * @copyright 2019 Adrián & Ferran
 * @license CC-BY-NC-SA
 * @version 1
 */
 
//echo $_SERVER['DOCUMENT_ROOT']."/partials/footer.php";
$central = "/../partials/centralForm.php";
include(dirname(__FILE__)."/../partials/header.php");
include(dirname(__FILE__)."/../partials/menu.php");
include(dirname(__FILE__).$central);
var_dump($GLOBALS);
include(dirname(__FILE__)."/../partials/footer.php");
?>