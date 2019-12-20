<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/wp-content/plugins/my_group1Rasoelectronic/css/style.css">
        <script src="/wp-content/plugins/my_group1Rasoelectronic/js/gestionFotos.js" async defer></script>
        <script src="/wp-content/plugins/my_group1Rasoelectronic/js/registroAsincrono.js" async defer></script>
    </head>
    <body>
         <h1>Gestión de Usuarios </h1>
    <form class="fom_usuario" action="?action=my_datosRasoelectronic&proceso=registrar" method="POST" enctype="multipart/form-data">
        <label class="titulo_label" for="clienteMail">Tu correo</label>
        <br/>
        <input type="text" name="clienteMail"  size="20" maxlength="25" value="<?php print $user_email?>"
        readonly />
        <br/>
        <legend class="titulo_legend">Datos básicos</legend>
        <label class="titulo_label" for="nombre">Nombre</label>
        <br/>
        <input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $MP_user["userName"] ?>"
        placeholder="Miguel Cervantes" required />
        <br/>
        <label class="titulo_label" for="email">Email</label>
        <br/>
        <input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $MP_user["email"] ?>"
        placeholder="kiko@ic.es" required />
        <br/>

        <br>
	<div>
		<label class="titulo_label" for="foto_file">Foto</label>
		<p> La mida de la nova foto no pot superar els 250 kb i el format ha de ser jpg </p>

		<img id="img_foto" src="" class="Foto">
		<br>
		<input id="foto" class="selector_imagen" type="file" name="foto_file" class="item_requerid" required>

		<br/>
	</div>
        <br>
        <input class="boton_undo" type="submit" value="Enviar">
        <input class="boton_undo" type="reset" value="Deshacer">
    </form>
    </body>
</html>
