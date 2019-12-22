<!DOCTYPE html>
<html>
    <head>
        <script src="/wp-content/plugins/my_group1Rasoelectronic/js/listadoAsincrono.js" async defer></script>
        <link rel="stylesheet" type="text/css" href="/wp-content/plugins/my_group1Rasoelectronic/css/style.css">
    </head>
    <body>
        <?php
            //Listado amigos o de todos si se es administrador.
            $a=array();
            if (current_user_can('administrator')) {$query = "SELECT     * FROM       $table ";}
            else {$campo="clienteMail";
                $query = "SELECT     * FROM  $table      WHERE $campo =?";
                $a=array( $user_email);
 
            } 

            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            $rows=$consult->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($rows)) {/* Creamos un listado como una tabla HTML*/
                print '<div><table>';
                foreach ( array_keys($rows[0])as $key) {
                    echo "<td class='column'>", $key,"</td>";
                }
                foreach ($rows as $row) {
                    print "<tr >";
                    foreach ($row as $key => $val) {
                        if($key == "foto_file"){
                            $fotoURL = "../wp-content/uploads/fotos_usuarios/".$val; //Mostrar la salida del campo foto
                            echo "<td class='column'>";
                            echo "<img class='Foto' src=$fotoURL>";
                            //echo "<td>";
                        } else {
                        echo "<td class='column'>", $val, "</td>";
                    }
                    }
                    //botones para modificar el cliente y borrarlo
                    echo "<td class='column'><a class='boton_update' href='?action=my_datosRasoelectronic&proceso=actualizar&person_id=", 
                    $row['person_id'],"'>Modificar</a></td>";
                    echo "<td class='column'><a class='boton_delete' href='?action=my_datosRasoelectronic&proceso=delete&person_id=",
                    $row['person_id'],"'>Eliminar</a></td>";
                    print "</tr>";
                }
                print "</table></div>";
            }
            else{echo "No existen usuarios";}
        ?>
    </body>
</html>
