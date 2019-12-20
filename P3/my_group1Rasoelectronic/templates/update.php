<?php
    global $table;
    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    $query = "SELECT * FROM $table WHERE person_id=?";
    $a=array( $_GET["person_id"]);
    $consult = $MP_pdo->prepare($query);
    $a=$consult->execute($a);
    $rows=$consult->fetchAll(PDO::FETCH_ASSOC);
	
    $usuario = $rows[0];
    $fotoURL = "../wp-content/uploads/fotos_usuario/" . $usuario["foto_file"];
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/wp-content/plugins/my_group1Rasoelectronic/css/style.css">
<!--         <script src="/wp-content/plugins/my_group1Rasoelectronic/js/gestionFotos.js" async defer></script> -->
    </head>
    <body>
        
         <h1>Modificación de perfil </h1>
    <form class="fom_usuario" action="?action=my_datosRasoelectronic&proceso=update&person_id=<?php print $_GET["person_id"] ?>" method="POST" enctype="multipart/form-data">
        <label class="titulo_label" for="clienteMail">Tu correo</label>
        <br/>
        <input type="text" name="clienteMail"  size="20" maxlength="25" value="<?php print $user_email?>"
        readonly />
        <br/>
        <legend class="titulo_legend">Datos básicos</legend>
        <label class="titulo_label" for="nombre">Nombre</label>
        <br/>
        <input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $usuario["nombre"] ?>" />
        <br/>
        <label class="titulo_label" for="email">Email</label>
        <br/>
        <input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $usuario["email"] ?>"/>
        <br/>
        <br>
        <label class="titulo_label" for="foto_file">Foto</label>
	<p> La mida de la nova foto no pot superar els 250 kb i el format ha de ser jpg </p>
        <img id="img_foto" src=<?php print $fotoURL ?> class="Foto">
        <br>
        <input id="foto" class="selector_imagen" type="file" name="foto_file" class="item_requerid">
        <br>

        <br/>
        <br>
        <input class="boton_undo" type="submit" value="Actualizar">
        <input class="boton_undo" type="reset" value="Deshacer">
    </form>
    </body>
</html>
