<?php

/**
 * Descripción: Programa Aprender PHP
 *
 * Descripción extensa: listar.php se encarga de listar todos los usuarios disponibles en la BD.
 *
 * @title: Practica 1: Aprender con PHP
 * @author Adrian Sorribas Segua & Ferran Ramia Tena  ;al361880@uji.es&al361866@uji.es; 
 * @copyright 2019 Adrián & Ferran
 * @license CC-BY-NC-SA
 * @version 1
 */

include("./gestionBD.php");

function handler($pdo,$table){
    
    $rows=consultar($pdo,$table);
   
    if (is_array($rows)) {/* Creamos un listado como una tabla HTML*/
        print '<table><thead>';
        foreach ( array_keys($rows[0])as $key) {
            echo "<th>", $key,"</th>";
        }
        print "</thead>";
        foreach ($rows as $row) {
            print "<tr>";
            foreach ($row as $key => $val) {
                echo "<td>", $val, "</td>";
                $identificador = $row["client_id"];
            }
            ?>
            <!-- Ejercicio 13 -->
            <!-- Creación de 2 botones por cada usuario, uno para modiicar y otro vinculado al borrado -->
            <td> 
            <button><a href="<?php print "portal.php?action=update&client_id=$identificador" ?>">Modificar</a></button>
            <button><a href="<?php print "portal.php?action=delete&client_id=$identificador" ?>">Borrar</a></button></td>
            <?php 
            print "</tr>";
        }
        print "</table>";
    }
}
$table = "A_cliente";


try{handler($pdo,$table);}
catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
}

?>