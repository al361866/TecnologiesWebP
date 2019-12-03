var ini, fin, ancho, largo;
function getMousePos(canvas, evt) {
				var rect = canvas.getBoundingClientRect();
				return {
					x: evt.clientX - rect.left,
					y: evt.clientY - rect.top
				};
}
		
		function limpiar(context) {
			canvas = document.querySelector('#sketchpad');
			context = canvas.getContext("2d");
			context.clearRect(0, 0, canvas.width, canvas.height);
		}
		function DibujaEnRaton(context, coors) {
      //Buscar si estamos dentro de la figura pintada
      console.log(ini, fin, ancho, largo);
      if(coors.x >= ini && coors.x < (ini+ancho) && coors.y >= fin && coors.y < (fin+largo)){
        context.fillStyle = "rgb(0,0,255)";
        context.fillRect(ini, fin, ancho, largo);
        
      }
      else {
        ini = coors.x;
        fin = coors.y;
        
        context.fillStyle = "rgb(255,0,0)";
        //Creación del cuadrado
        ancho= Math.floor((Math.random() * 100) + 1);
        largo= Math.floor((Math.random() * 100) + 1);
        context.fillRect(coors.x, coors.y, ancho, largo);
        }
			}
		function ready() {
			var imagen = document.querySelector("#img_foto");
			var canvas = document.querySelector("#sketchpad");
			context = canvas.getContext('2d');
			canvas.addEventListener("click",function(evt){
				coors=getMousePos(canvas, evt);
				DibujaEnRaton(context, coors) ;
			})
			document.querySelector("#limpiar").addEventListener("click", function () {
				limpiar(context);
			});
		}
		ready();