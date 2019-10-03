<?php

 include("./gestionBD.php");
    $client_id=$_GET['client_id'];
    if($client_id != null) {
        $table="A_cliente";
        $clienteCompleto = consultar_usuario($pdo,$table, $client_id);
     } 
 
 ?>
<main>
	<h1>Actualización de Usuario </h1>
	<form class="fom_usuario" action="?action=editar" method="POST">
        <input type="hidden" name="id" value="<?php print $clienteCompleto["client_id"];  ?>">
		<legend>Datos básicos</legend>
		<label for="nombre">Nombre</label>
		<br/>
	<input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $clienteCompleto["nombre"]; ?>"
		 placeholder="Adrian" />
		<br/>
		<label for="apellido">Apellidos</label>
		<br/>
		<input type="text" name="apellidos" class="item_requerid" size="20" maxlength="50" value="<?php print $clienteCompleto["apellidos"]; ?>"
		 placeholder="Sorribas" />
		 <br/>
		 	<label for="dni">DNI</label>
		<br/>
		<input type="text" name="dni" class="item_requerid" size="20" maxlength="9" value="<?php print $clienteCompleto["dni"]; ?>"
		 placeholder="123A" />
		 <br/>
		<label for="email">Email</label>
		<br/>
		<input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $clienteCompleto["email"]; ?>"
		 placeholder="adri@uji.es" />
		<br/>

		<label for="passwd">Clave</label>
		<br/>
		<input type="password" name="passwd" class="item_requerid" size="8" maxlength="25" value="<?php print $clienteCompleto["clave"]; ?>"
		/>
		<br/>
		<input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
	</form>
</main>