<?php
/*
Plugin Name: my_groupRasoelectronic
Description: Register group of persons.
Author URI: Ferran & Adrian
Author Email: al361866@uji.es & al361880@uji.es
Descripcion: Nueva versión del plugin
Version: 2.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/



//Al activar el plugin quiero que se cree una tabla en la BD, que creará la función my_group_install.



//Añado action hook, de forma que cuando se realice la acción de una petición a la URL: wp-admin/admin-post.php?action=my_datos 
//se llame a mi controlador definido en la función my_datos definido en el fichero include/functions.php

//Solo activado el hook para usuarios autentificados,  



//La siguiente sentencia activaria la acción para todos los usuarios.
//add_action('admin_post_nopriv_my_datos', 'my_datos');
$table="A_GrupoCliente000";
include(plugin_dir_path( __FILE__ ).'include/functions.php');

register_activation_hook( __FILE__, 'MP_Ejecutar_crearTRasoelectronic');

//add_action( 'plugins_loaded', 'Ejecutar_crearT' ); // esto se ejecuta siempre que se llama al plugin
function MP_Ejecutar_crearTRasoelectronic(){
    MP_CrearTRasoelectronic("A_GrupoCliente000");
}
//add_action('admin_post_nopriv_my_datos', 'MP_my_datos'); //no autentificados

function my_init_script(){
	$deps=array();
    	wp_enqueue_script('gestionFotos', '/wp-content/plugins/my_group1Rasoelectronic/js/gestionFotos.js',$deps,true, true);	
	wp_enqueue_script('registroAsincrono', '/wp-content/plugins/my_group1Rasoelectronic/js/registroAsincrono.js',$deps,true, true);
    }

function shortcode_Listado() {
      return '<script src="/wp-content/plugins/my_group1Rasoelectronic/js/listadoAsincrono.js" async defer></script><a id="listadoJSON">Listado asíncrono</a>';
}

function my_shortcode_styles() {
    global $post;
 
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'shortcode_name' ) ) {
        wp_enqueue_style( 'shortcode-css', get_theme_file_uri( '/wp-content/plugins/my_group1Rasoelectronic/css/styles.css' ) );
    }
}
add_action( 'wp_enqueue_scripts', 'my_shortcode_styles' );

add_shortcode('listado', 'shortcode_Listado');

add_action('wp_enqueue_scripts', 'my_init_script');
add_action('admin_post_my_datosRasoelectronic', "MP_my_datosRasoelectronic"); 

?>
