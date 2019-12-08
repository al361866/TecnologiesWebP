var ini, fin, ancho, largo,areaPintada,areaTotal,areaSinPintar,contador=0,max=0;
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
     
     function area(){       
       areaTotal =  canvas.width* canvas.height;
       areaPintada = ancho*largo;
       areaSinPintar = areaTotal-areaPintada;
     }

    function compruebaCorrecto(context, coors) {
      
      context.font = "30px Verdana";
      // Create gradient
      var gradient = context.createLinearGradient(0, 0, canvas.width, 0);
      gradient.addColorStop("0"," magenta");
      gradient.addColorStop("0.5", "blue");
      gradient.addColorStop("1.0", "red");
      
       if(areaPintada < areaSinPintar){ //Area pintada es pequeña
         
         if (coors.x >= 0 && coors.x <= largo){
               	//Vamos bien
           contador++;
             console.log('Be de tot ROIG');
             dibuja(context);
             area();
             dibujaResto(context);
          }else{
            //Perdemos
              console.log('MAL');

              context.fillStyle = "rgb(230,120,150)";
              context.fillRect(0, 0, canvas.width, canvas.height);
              context.fillStyle = gradient;
              context.fillText("GAME OVER", 30, 90);
              context.font = "bold 22px sans-serif";
              context.fillText("Score: " + contador,80,120);
               
              if(contador>max){
                max = contador;
              }
             context.fillText("Best score: " + max,60,140);

            contador = 0;
            

            
          } 
       }else{
          
          if (coors.x >= largo){
              //Vamos Bien
            contador++;
             console.log('Be de tot VERD');
             dibuja(context);
             area();
             dibujaResto(context);

          }else{
            
            console.log('MAL');

            context.fillStyle = "rgb(255,120,250)";
            context.fillRect(0, 0, canvas.width, canvas.height);
            context.fillStyle = gradient;
            context.fillText("GAME OVER", 30, 90);
            context.font = "bold 22px sans-serif";
            context.fillText("Score: " + contador,80,120);

            if(contador>max){
                max = contador;
            }
            context.fillText("Best score: " + max,60,140);

            contador= 0;
          }
       }
  	
    }

    function dibuja(context) {
           context.fillStyle = "rgb(200,0,0)";
           largo= Math.floor((Math.random() * canvas.width));
           ancho = canvas.height
           context.fillRect(0, 0, largo, canvas.height);
     }
      function dibujaResto(context) {
           context.fillStyle = "rgb(0,200,0)";
           context.fillRect(largo, 0, canvas.width, canvas.height);
     }

     function start(context){
             limpiar(context);
             dibuja(context);
             area();
             dibujaResto(context);
     }
     

   	 function ready() {
   		 var imagen = document.querySelector("#img_foto");
   		 var canvas = document.querySelector("#sketchpad");
       context = canvas.getContext('2d');

       canvas.addEventListener("click",function(evt){
           //limpiar(context);
           coors=getMousePos(canvas, evt);
           compruebaCorrecto(context, coors);
   		 })

       document.querySelector("#start").addEventListener("click", function () {
   			 start(context);
   		 });
       
   	 }

   	 ready();
