<?php
/**
 * * Descripción: Controlador principal
 * *
 * * Descripción extensa: Iremos añadiendo cosas complejas en PHP.
 * *
 * * @author  Ferran Ramia & Adrian Sorribas 
 * * @copyright 2019 Ferran & Adrina
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 * */


//Estas 2 instrucciones me aseguran que el usuario accede a través del WP. Y no directamente
if ( ! defined( 'WPINC' ) ) exit;

if ( ! defined( 'ABSPATH' ) ) exit;

function my_init_script(){
    	wp_enqueue_script('gestionFotos', get_template_directory_uri() . '/js/gestionFotos.js', true);	
	wp_enqueue_script('registroAsincrono', get_template_directory_uri() . '/js/registroAsincrono.js', true);
    }

    add_action('wp_enqueue_scripts', 'my_init_script');


//Funcion instalación plugin. Crea tabla
function MP_CrearTRasoelectronic($tabla){
    
    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    $query="CREATE TABLE IF NOT EXISTS $tabla (person_id INT(11) NOT NULL AUTO_INCREMENT, nombre VARCHAR(100),  email VARCHAR(100),  foto_file VARCHAR(100), clienteMail VARCHAR(100),  PRIMARY KEY(person_id))";
    $consult = $MP_pdo->prepare($query);
    $consult->execute (array());
}

//CONTROLADOR
//Esta función realizará distintas acciones en función del valor del parámetro
//$_REQUEST['proceso'], o sea se activara al llamar a url semejantes a 
//https://host/wp-admin/admin-post.php?action=my_datosRasoelectronic&proceso=r 

function MP_my_datosRasoelectronic()
{ 
    global $user_ID , $user_email, $table;
    
    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    wp_get_current_user();
    if ('' == $user_ID) {
                //no user logged in
                exit;
    }
       
    if (!(isset($_REQUEST['action'])) or !(isset($_REQUEST['proceso']))) { print("Opciones no correctas $user_email"); exit;}

    if (!(isset($_REQUEST['partial']))) {
        get_header();
    }
    echo '<div class="wrap">';

    switch ($_REQUEST['proceso']) {
        //funcion de borrar
        case "delete":
            $query = "DELETE   FROM   $table WHERE person_id =(?)";
            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute(array($_GET["person_id"])); 
            if (1>$a) echo "InCorrecto Delete";
            else wp_redirect(admin_url( 'admin-post.php?action=my_datosRasoelectronic&proceso=listar'));
            break;
        //funcion de update
        case "update":
             if (count($_REQUEST) < 4) { //Al ser un parámetro más, incrementamos el num de parámetros
                print ("No has rellenado el formulario correctamente");
                return;
            }
            $fotoURL="";
            $foto = "";
            $IMAGENES_USUARIOS = '/wp-content/uploads/fotos_usuarios/';
            $actual_path = realpath(dirname(getcwd()));//Obtener path actual
            //echo $actual_path;           
            if(array_key_exists('foto_file', $_FILES) && $_POST['email']) {
                $foto = $_POST['userName']."_".$_FILES['foto_file']['name'];
                $fotoURL = $actual_path.$IMAGENES_USUARIOS.$foto;

                //Creamos todo el path de la foto
                if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $fotoURL))
                    { echo "foto subida con éxito";
                }else {echo "foto no subida";}
            }

            
	    $query = "UPDATE $table SET nombre=(?), email=(?), clienteMail=(?), foto_file=(?) WHERE  person_id =(?)";
            $a=array($_REQUEST['userName'], $_REQUEST['email'],$_REQUEST['clienteMail'],$foto, $_GET["person_id"]);// Se anyade la consulta de la foto
            
            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            if (1>$a) {echo "InCorrecto $query";}
            else wp_redirect(admin_url( 'admin-post.php?action=my_datosRasoelectronic&proceso=listar'));//Redireccionamos la salida para mostrar la salida
            break;
        case "registro":
            $MP_user=null; //variable a rellenar cuando usamos modificar con este formulario
            include_once(plugin_dir_path(__FILE__) . '../templates/registro.php');
		    //MP_Register_FormRasoelectronic($MP_user,$user_email);
            break;
        case "actualizar":
	    include_once(plugin_dir_path(__FILE__) . '../templates/update.php');
            //MP_Update_FormRasoelectronic($user_email);
            break;
        case "registrar":
            if (count($_REQUEST) < 4) { //Al ser un parámetro más, incrementamos el num de parámetros
                print ("No has rellenado el formulario correctamente");
                return;
            }
            $fotoURL="";
            $foto = "";
            $IMAGENES_USUARIOS = '/wp-content/uploads/fotos_usuarios/';
            $actual_path = realpath(dirname(getcwd()));//Obtener path actual
            //echo $actual_path;
            var_dump($_FILES);
            if(array_key_exists('foto_file', $_FILES) && $_POST['email']) {
                $foto = $_POST['userName']."_".$_FILES['foto_file']['name'];
                $fotoURL = $actual_path.$IMAGENES_USUARIOS.$foto;

                //Creamos todo el path de la foto
                if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $fotoURL))
                    { echo "foto subida con éxito";
                }else {echo "foto no subida";}
            }

            $query = "INSERT INTO $table (nombre, email,clienteMail,foto_file) VALUES (?,?,?,?)";//Anyadimos campo de foto a la consulta         
            $a=array($_REQUEST['userName'], $_REQUEST['email'],$_REQUEST['clienteMail'],$foto );// Se anyade la consulta de la foto
            
            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            if (1>$a) {echo "InCorrecto $query";}
            else wp_redirect(admin_url( 'admin-post.php?action=my_datosRasoelectronic&proceso=listar'));//Redireccionamos la salida para mostrar la salida
            break;
		    
 	case "listar":
            //Listado amigos o de todos si se es administrador.
            include_once(plugin_dir_path(__FILE__) . '../templates/listar.php');
            break;
		    
	//listar json, falte modificar
        case "listarjson":
             $a=array();
            if (current_user_can('administrator')) {$query = "SELECT     * FROM       $table ";}
            else {
		$campo="clienteMail";
                $query = "SELECT     * FROM  $table      WHERE $campo =?";
                $a=array( $user_email);
            } 
            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            $rows=$consult->fetchAll(PDO::FETCH_ASSOC);  
            echo json_encode($rows);
            break;
        default:
            print "Opción no correcta";
        
    }
    echo "</div>";
    // get_footer ademas del pie de página carga el toolbar de administración de wordpres si es un 
    //usuario autentificado, por ello voy a borrar la acción cuando no es un administrador para que no aparezca.
    if (!current_user_can('administrator')) {

        // for the admin page
        remove_action('admin_footer', 'wp_admin_bar_render', 1000);
        // for the front-end
        remove_action('wp_footer', 'wp_admin_bar_render', 1000);
    }
	
    if (!(isset($_REQUEST['partial']))) {
       get_footer();
   }
	
	
    }
   ?>
