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




//Funcion instalación plugin. Crea tabla
function MP_CrearTRasoelectronic($tabla){
    
    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    $query="CREATE TABLE IF NOT EXISTS $tabla (person_id INT(11) NOT NULL AUTO_INCREMENT, nombre VARCHAR(100),  email VARCHAR(100),  foto_file VARCHAR(100), clienteMail VARCHAR(100),  PRIMARY KEY(person_id))";
    $consult = $MP_pdo->prepare($query);
    $consult->execute (array());
}


function MP_Register_FormRasoelectronic($MP_user , $user_email)
{//formulario registro amigos de $user_email
    ?>
   
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
        placeholder="Miguel Cervantes" />
        <br/>
        <label class="titulo_label" for="email">Email</label>
        <br/>
        <input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $MP_user["email"] ?>"
        placeholder="kiko@ic.es" />
        <br/>

        <br>
        <label class="titulo_label" for="foto_file">Foto</label>
	<p> La mida de la nova foto no pot superar els 250 kb i el format ha de ser jpg </p>

        <img id="img_foto" src="" class="Foto">
        <br>
        <input id="foto" class="selector_imagen" type="file" name="foto_file" class="item_requerid">

        <br/>
        <br>
        <input class="boton_undo" type="submit" value="Enviar">
        <input class="boton_undo" type="reset" value="Deshacer">
    </form>
    <script type="text/javascript" defer charset="utf-8">

      function mostrarFoto(file, imagen) {
      //carga la imagen de file en el elemento src imagen
         var reader = new FileReader();
         reader.addEventListener("load", function () {
            if (!(/\.(jpg)$/i).test(file.name)) {
		alert('El archivo a adjuntar no es una imagen valida .jpg');
		imagen.src = "";
		document.querySelector("#foto").value="";
	    }else {
		if (file.size > 250000){
			alert('El peso de la imagen no puede exceder los 250kb y tu imagen tiene: ');
			imagen.src = "";
			document.querySelector("#foto").value="";
		}else {
			imagen.src = reader.result;
			alert('Imagen correcta.');            
		    }
		}
        });
 reader.readAsDataURL(file);
      }

      function ready() {
         var fichero = document.querySelector("#foto");
         var imagen  = document.querySelector("#img_foto");
      //escuchamos evento selección nuevo fichero.
         fichero.addEventListener("change", function (event) {
            mostrarFoto(this.files[0], imagen);
         });
      }

      ready();

   </script>
<?php
}

//funcion con el formulario para modificar los datos de los usuarios
function MP_Update_FormRasoelectronic($user_email)
{//formulario actualizar datos de $user_email
    global $table;
    //Recuperación de datos
    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    $query_datos = "SELECT * FROM $table WHERE person_id=?";
    $a=array($_GET["person_id"]);
    
    $consult = $MP_pdo->prepare($query_datos);
    $consult->execute ($a);
    $rows=$consult->fetchAll(PDO::FETCH_ASSOC);
    
    $usuario=$rows[0];
    $fotoURL = "../wp-content/uploads/fotos_usuarios/" . $usuario["foto_file"];

    ?>
   
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
    <script type="text/javascript" defer charset="utf-8">

      function mostrarFoto(file, imagen) {
      //carga la imagen de file en el elemento src imagen
         var reader = new FileReader();
         reader.addEventListener("load", function () {
            if (!(/\.(jpg)$/i).test(file.name)) {
		alert('El archivo a adjuntar no es una imagen valida .jpg');
		imagen.src = "";
		document.querySelector("#foto").value="";
	    }else {
		if (file.size > 250000){
			alert('El peso de la imagen no puede exceder los 250kb y tu imagen tiene: ');
			imagen.src = "";
			document.querySelector("#foto").value="";
		}else {
			imagen.src = reader.result;
			alert('Imagen correcta.');            
		    }
		}
        });
 reader.readAsDataURL(file);
      }

      function ready() {
         var fichero = document.querySelector("#foto");
         var imagen  = document.querySelector("#img_foto");
      //escuchamos evento selección nuevo fichero.
         fichero.addEventListener("change", function (event) {
            mostrarFoto(this.files[0], imagen);
         });
      }

      ready();

   </script>
<?php
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

    get_header();
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
            MP_Register_FormRasoelectronic($MP_user,$user_email);
            break;
        //falta poner las opciones de actualizar, que llama a la funcion de update creada anteriormente
        case "actualizar":
            MP_Update_FormRasoelectronic($user_email);
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
                    echo "<td>", $key,"</td>";
                }
                foreach ($rows as $row) {
                    print "<tr>";
                    foreach ($row as $key => $val) {
                        if($key == "foto_file"){
                            $fotoURL = "../wp-content/uploads/fotos_usuarios/".$val; //Mostrar la salida del campo foto
                            echo "<td>";
                            echo "<img class='Foto' src=$fotoURL>";
                            //echo "<td>";
                        } else {
                        echo "<td>", $val, "</td>";
                    }
                    }
                    //botones para modificar el cliente y borrarlo
                    echo "<td ><a class='boton_update' href='?action=my_datosRasoelectronic&proceso=actualizar&person_id=", 
                    $row['person_id'],"'>Modificar</a></td>";
                    echo "<td><a class='boton_delete' href='?action=my_datosRasoelectronic&proceso=delete&person_id=",
                    $row['person_id'],"'>Eliminar</a></td>";
                    print "</tr>";
                }
                print "</table></div>";
            }
            else{echo "No existen usuarios";}
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

    get_footer();
    }
   ?>
      
   <?php
}
add_action('wp_head', 'hook_css');
?>
