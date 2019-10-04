<?php
/**
 * Descripción: Programa Aprender PHP
 *
 * Descripción extensa: Fichero centralForm.php.
 *
 * @title: Practica 1: Aprender con PHP
 * @author Adrian Sorribas Segua & Ferran Ramia Tena  ;al361880@uji.es&al361866@uji.es; 
 * @copyright 2019 Adrián & Ferran
 * @license CC-BY-NC-SA
 * @version 1
 */
?>

<main>
	<h1>Gestion de Usuarios </h1>
	<form class="fom_usuario" action="?action=controlForm" method="POST">
		<fieldset>
			<legend>Datos básicos</legend>
			<label for="nombre">Nombre</label>
			<br/>
			<input type="text" name="nombre" class="item_requerid" size="20" maxlength="25" value="<?php print $nombre ?>"
			 placeholder="Miguel" />
			<br/>
			<label for="apellidos">Apellidos</label>
			<br/>
			<input type="text" name="apellido" class="item_requerid" size="20" maxlength="25" value="<?php print $apellido ?>"
			 placeholder="Cervantes" />
			<br/>
		</fieldset>
		<input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
	</form>
</main>