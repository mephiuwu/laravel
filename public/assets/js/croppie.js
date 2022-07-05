$('#btn-image').on('click',function(e){
    e.preventDefault();
    console.log('llegó');
   $('#image-file').click();
});

//ancho y alto maximo permitido
var corte_ancho_imagen = 230;
var corte_alto_imagen = 230;    
var corte_ancho_imagen_resp = 800;
var corte_alto_imagen_resp = 500;
var tipo_recorte = "square";

$('#image-file').on('change',function(e){

     
    //archivo
    const file = this.files[0];

    //validar tipo de archivo subido
    var archivo_nombre = file.name.toString();
       
    var filename = archivo_nombre.split("\\").pop().split("/").pop();
    var ext = (filename.substr(( Math.max(0, filename.lastIndexOf(".")) || Infinity) + 1));

    if(!(ext == "jpg" || ext == "jpeg" || ext == "png" || ext == "gif")){
        alert("formato no permitido");
        throw new Error("Ha ocurrido un error inesperado!");
    }
    
      
      var reader = new FileReader();
        
      var razon;
        if (corte_ancho_imagen > 1500) {
              razon = 4;
        }else if(corte_ancho_imagen >= 500 && corte_ancho_imagen < 1500 ){
            razon = 2;
        }else{
            razon = 1;
        }
      reader.onload = function (e) {
        $("#croppie_imagen").remove();
        $('#container-image').empty();
        $("#container-image").append('<div id="croppie_imagen"></div>');
        
        //crear imagen 
        var img = new Image();
        img.onload = function(){
           console.log(img.height,img.width);
        }
        img.src = reader.result;

      
      
        $('#croppie_imagen').croppie({
          //tamaño de recortador
          viewport: {
              width: corte_ancho_imagen/razon,
              height: corte_alto_imagen/razon,
              type: $("#tipo_croppie_imagen").val(),
          },
          url: e.target.result,
          /* enableResize: true, */
          enableOrientation: true,
          mouseWheelZoombool:true,
          showZoomer: true, 
          //tamaño del contenedor imagen
          boundary: {
              width: (corte_ancho_imagen /razon) +30 ,
              height: (corte_alto_imagen /razon) +30,
          }
        });
      }
      reader.readAsDataURL(this.files[0]);

      console.log(reader,this.files[0]);

    
     $('#tipo_croppie_imagen').on('change',function(){

        $("#croppie_imagen").remove();
        
        $("#container-image").append('<div id="croppie_imagen"></div>');

        $('#croppie_imagen').croppie({
            //tamaño de recortador
            viewport: {
                width: corte_ancho_imagen/razon,
                height: corte_alto_imagen/razon,
                type: $(this).val(),
            },
           
            /* enableResize: true, */
            enableOrientation: true,
            mouseWheelZoombool:true,
            showZoomer: true, 
            //tamaño del contenedor imagen
            boundary: {
                width: (corte_ancho_imagen /razon) +30 ,
                height: (corte_alto_imagen /razon) +30,
            }
          });
     });
   
    
  
});

$('#btn-upload').on('click',function(e){
  e.preventDefault();
  if($("#image-file").val() == ""){
        alert('Debe ingresar una imagen');
        return false;
  }

  $("#croppie_imagen").croppie("result", {
            "type": "base64", 
            "format": "jpeg|png|gif|jpg", 
            "size": {width: corte_ancho_imagen, height: corte_alto_imagen},//tamaÃ±o final de corte
            "quality": 1
        }).then(function (img) {   
            //Una vez cumplida la promise envio el form
            //Doy el valor del crop a un hidden y lo enví­o como base 64
            $("#croppie_result_imagen").val(img);

            console.log( $("#croppie_result_imagen").val());
          /*   $.ajax({
                url: module_url+"process_croppie",
                type: "post",
                dataType: "json",
                data: {"image64": $("#croppie_result_imagen").val()},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (json) {
                    if (json.result) {
                       
                      
                    }else{
                        alertify.error(json.msg).dismissOthers();
                    }
                }
            }); */
        });
});




