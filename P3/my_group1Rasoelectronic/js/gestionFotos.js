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
