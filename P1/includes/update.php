<?php
include("./gestionBD.php");
function handler($pdo,$table)
{

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