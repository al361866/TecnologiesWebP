<?php
    //view_form.php

/**
 * Descripción: Programa Aprender PHP
 *
 * Descripción extensa: portal.php gestiona y controla los distintos action definidos en la URL.
 *
 * @title: Practica 1: Aprender con PHP
 * @author Adrian Sorribas Segua & Ferran Ramia Tena  ;al361880@uji.es&al361866@uji.es; 
 * @copyright 2019 Adrián & Ferran
 * @license CC-BY-NC-SA
 * @version 1
 */

//echo $_SERVER['DOCUMENT_ROOT']."/partials/footer.php";
$central = "/../partials/centralForm.php";
if (isset($_REQUEST['action'])) $action = $_REQUEST["action"];
else $action = "home";

switch ($action) {
    case "home":
        $central = "/../partials/centralForm.php";
        break;
    case "controlForm":
        $central = "/controlForm.php";
        break;
    case "crearTabla":
        $central = "/crearTabla.php";
        break;
    case "delete":
        $central = "/borrarRegistre.php";
        break;
    case "registro":
         $central = "/../partials/registerForm.php";
        break;
    case "editar":
         $central = "/update.php";
        break;
    case "update":
        $central = "/../partials/updateForm.php";
        break;
    case "registrar":
        $central = "/registrar.php";
        break;
    case "listar":
        $central = "/listar.php";
        break;
    default:
        $data["error"] = "Accion No permitida";
        $central = "/../partials/centralForm.php";
}

include(dirname(__FILE__)."/../partials/header.php");
include(dirname(__FILE__)."/../partials/menu.php");
include(dirname(__FILE__).$central);
include(dirname(__FILE__)."/../partials/footer.php");
?>