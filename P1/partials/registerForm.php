<main>
	<h1>GestiÓn de Usuarios </h1>
	<form class="fom_usuario" action="?action=registrar" method="POST">

		<legend>Datos básicos</legend>
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $userName ?>"
		 placeholder="Miguel" />
		<br/>
		<label for="nombre">Apellidos</label>
		<br/>
		<input type="text" name="surName" class="item_requerid" size="50" maxlength="25" value="<?php print $surName ?>"
		 placeholder="Cervantes" />
		<br/>
		<label for="email">Email</label>
		<br/>
		<input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $email ?>"
		 placeholder="cervi@ic.es" />
		 <br/>
		<label for="nombre">DNI</label>
		<br/>
		<input type="text" name="dni" class="item_requerid" size="10" maxlength="25" value="<?php print $dni ?>"
		 placeholder="123" />
		<br/>
		<label for="passwd">Clave</label>
		<br/>
		<input type="password" name="passwd" class="item_requerid" size="8" maxlength="25" value="<?php print $passwd ?>"
		/>
		<br/>
		<label for="passwd">Foto perfil</label>
		<br/>
		<input type="text" name="foto_file" class="item_requerid" size="20" maxlength="25" value="<?php print $foto_file ?>"
		 placeholder="Miguel Cervantes" />
		<br/>
		<input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
	</form>
</main>