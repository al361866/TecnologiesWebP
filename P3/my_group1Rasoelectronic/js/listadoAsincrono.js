function cargarTemplate(datos) {
			// Test to see if the browser supports the HTML template element by checking
			// for the presence of the template element's content attribute.
			if (document.querySelector('template').content) {

				// Instantiate the table with the existing HTML tbody and the row with the template
				var t = document.querySelector('#productrow');
				var tb = document.getElementsByTagName("tbody");
				var clone;

				td = t.content.querySelectorAll("td");
				for (var i = 0; i < datos.length; i++) {

					td[0].textContent = datos[i].person_id;
					td[1].textContent = datos[i].nombre;
					td[2].textContent = datos[i].email;
					var fotoURL = "../wp-content/uploads/fotos_usuarios/" + datos[i].foto_file;
					td[3].children[0].src = fotoURL;
					td[4].textContent = datos[i].clienteMail;
					td[5].children[0].href = "?action=my_group1Rasoelectronic&proceso=actualizar&person_id=" + datos[i].person_id;
					td[6].children[0].href = "?action=my_group1Rasoelectronic&proceso=delete&person_id=" + datos[i].person_id;

					clone = document.importNode(t.content, true);
					tb[0].appendChild(clone);

				}
			}
}

async function pideTemplate(template, datos) {
    let init2 = {
        url: template,
        method: 'get'
    };
    let request1 = new Request(template, init2);
    const response2 = await fetch(request1);  
    if (!response2.ok) {
       alert("Error no se ha podido cargar el template"); 
    } else {
        const html = await response2.text();
	console.log(html);
        document.querySelector('#content').innerHTML=html;
        cargarTemplate(datos);
    }
}

async function pideListado(evento) {
    try {
        evento.preventDefault();
        let url = "/wp-admin/admin-post.php?action=my_group1Rasoelectronic&proceso=listarjson";
        let init = {
            url: url,
            method: 'get'
        };
	    
        let request0 = new Request(url, init);
        const response = await fetch(request0);  
        if (!response.ok) {
           alert("Error no se ha podido cargar el json"); 
        } else {
            const result = await response.json();
            pideTemplate(result.template, result.datos);
        }   
   } catch (error) {
        console.log(error);
   }
}

var listado = document.querySelector("#listadoJSON");
listado.addEventListener("click", function (event) {
     pideListado(event);
});
