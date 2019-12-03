<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  }


add_filter("the_content", "mfp_Fix_Text_Spacing");
  // Automatically correct double spaces from any post
  function mfp_Fix_Text_Spacing($the_Post)
  {
  $the_New_Post = str_replace("electrónica", " ELECTRÓNICA ", $the_Post);
  return $the_New_Post;
  }

function add_theme_scripts(){
  $deeps = array();
 wp_enqueue_script( 'ej8', get_stylesheet_directory_uri().'/js/ej8.js',$deeps,true);
}


//codi per a afegir el joc
function shortcode_ejercicio8() {
  return '<h3 class="centra"> Juego Ejercicio 8</h3>
          <canvas id="sketchpad" width="240" height="160" style="background-color: #ccffcc;"></canvas>
          <p>	<button id="limpiar"> LIMPIAR</button></p>
  ';
}
add_shortcode('juego_ej8', 'shortcode_ejercicio8');
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

?>
