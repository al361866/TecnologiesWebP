document.forms[0].addEventListener("submit", function (event) {
     enviaForm(event);
});
async function enviaForm(evento) {
    try {
        evento.preventDefault();
        let url = evento.target.getAttribute("action");
        let data = new FormData(evento.target);
        let init = {
            url: url,
            method: 'post',
            body: data
        };
        let request0 = new Request(url, init);

        const response = await fetch(request0);

        
        
        if (!response.ok) {
           if (window.confirm('El usuario no se ha podido añadir. ¿Quieres volver a intentarlo?')) {
                window.location.href='https://rasoelectronic.000webhostapp.com/wp-admin/admin-post.php?action=my_datosRasoelectronic&proceso=registro';
            }
            window.alert(". ");     
        } else {
            const result = await response.text();
             if (window.confirm('"Usuario añadido con éxito. ¿Ir al listado de amigos?')) {
                window.location.href='https://rasoelectronic.000webhostapp.com/wp-admin/admin-post.php?action=my_datosRasoelectronic&proceso=listar';
            }

        }
             
   } catch (error) {
        console.log(error);
   }
}
