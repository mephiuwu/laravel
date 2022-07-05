@extends('layouts.admin')

@section('title')
  Configuración Empresa   
@endsection

@section('content')

<style>
  /* Set the size of the div element that contains the map */
  #map {
    height: 400px;
    /* The height is 400 pixels */
    width: 100%;
    /* The width is the width of the web page */
  }
</style>



<div class="relative  flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded  bg-white">
  <div class="rounded-t mb-0 px-4 py-3 border-0">
    <div class="flex flex-wrap items-center">
      <div class="relative w-full px-4 max-w-full flex-grow flex-1">
        <h3 class="font-semibold text-lg text-blueGray-700">
          Administrar empresa
        </h3>
      </div>
    </div>
  </div>
  <div class="block w-full p-4 overflow-x-auto">
    <form action="{{route('empresa.update',$empresa->id)}}" enctype="multipart/form-data" method="post">
      @csrf
      @method('PUT')
      <div class="flex w-full flex-start">
        <h2 class="text-dark text-xl font-sans font-bold py-4">Información Personal</h2>
      </div>


      <div class="grid lg:grid-cols-2 gap-6">
        <div>
          <x-label for="razon_social" class="font-sans font-semibold" value="Razón Social: "></x-label>
          <x-input class="block mt-1 w-full" type="text" name="razon_social" value="{{$empresa->emp_razon_social}}">
          </x-input>
          @error('razon_social')
          <b class="text-red-500">{{$message}}</b>
          @enderror
        </div>
        <div>
          <x-label for="email_empresarial" class="font-sans font-semibold" value="Email Empresarial: ">
          </x-label>
          <x-input class="block mt-1 w-full" type="email" name="email_empresarial"
            value="{{$empresa->emp_email_empresarial}}"></x-input>
          @error('email_empresarial')
          <b class="text-red-500">{{$message}}</b>
          @enderror
        </div>

        <div>
          <x-label for="direccion" class="font-sans font-semibold" value="Dirección"></x-label>
          <x-input class="block mt-1 w-full " type="text" name="direccion" value="{{$empresa->emp_direccion}}">
          </x-input>
          @error('direccion')
          <b class="text-red-500">{{$message}}</b>
          @enderror
        </div>

  </div>
  <div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
      <div class="border-t border-gray-200"></div>
    </div>
  </div>

  <div class="flex w-full flex-start">
    <h2 class="text-dark text-xl font-sans font-bold py-4">Datos analíticos</h2>
  </div>
  <div class="grid lg:grid-cols-2 gap-6 py-4">
    <div>
      <x-label for="meta_title" class="font-sans font-semibold" value="Meta Title: "></x-label>
      <x-input class="block mt-1 w-full" type="text" name="meta_title" value="{{$empresa->emp_meta_title}}">
      </x-input>
      @error('meta_title')
      <b class="text-red-500">{{$message}}</b>
      @enderror
    </div>

    <div>
      <x-label for="meta_keywords" class="font-sans font-semibold" value="Meta Keywords: "></x-label>
      <x-input class="block mt-1 w-full" type="text" name="meta_keywords" value="{{$empresa->emp_meta_keywords}}">
      </x-input>
      @error('meta_keywords')
      <b class="text-red-500">{{$message}}</b>
      @enderror
    </div>

    <div>
      <x-label for="meta_description" class="font-sans font-semibold" value="Meta Description: "></x-label>
      <textarea style="max-width: 100%; min-width: 100%; min-height: 100px;" 
        class="border border-gray-300 rounded-md block mt-1 w-full p-3" rows="4" name="meta_description" required>{{$empresa->emp_meta_description}}</textarea>
      @error('meta_description')
      <b class="text-red-500">{{$message}}</b>
      @enderror
    </div>
    <div>
      <x-label for="analytics" class="font-sans font-semibold" value="Google Analytics: "></x-label>
      <textarea style="max-width: 100%; min-width: 100%; min-height: 100px;" 
        class="border border-gray-300 rounded-md block mt-1 w-full p-3" rows="4" name="analytics" required>{{$empresa->emp_analytics}}</textarea>
      @error('analytics')
      <b class="text-red-500">{{$message}}</b>
      @enderror
    </div>
  </div>

  <div class="hidden sm:block" aria-hidden="true">
      <div class="py-5">
          <div class="border-t border-gray-200"></div>
      </div>
  </div>

  <div class="flex w-full flex-start">
    <h2 class="text-dark text-xl font-sans font-bold py-4">Información de Contacto</h2>
  </div>
  <div class="grid lg:grid-cols-2 gap-6">
    <div>
      <x-label for="telefono" class="font-sans font-semibold" value="Teléfono: "></x-label>
      <x-input class="block mt-1 w-full" type="tel" name="telefono" value="{{$empresa->emp_telefono}}">
      </x-input>
      @error('telefono')
      <b class="text-red-500">{{$message}}</b>
      @enderror
    </div>

    <div>
      <x-label for="email_contacto" class="font-sans font-semibold" value="Email de Contacto: "></x-label>
      <x-input class="block mt-1 w-full" type="email" name="email_contacto" value="{{$empresa->emp_email_contacto}}">
      </x-input>
      @error('email_contacto')
      <b class="text-red-500">{{$message}}</b>
      @enderror
    </div>

    <div>
      <x-label for="facebook_url" class="font-sans font-semibold" value="Url Facebook: "></x-label>
      <x-input class="block mt-1 w-full" type="text" name="facebook_url" value="{{$empresa->emp_url_facebook}}">
      </x-input>
      @error('facebook_url')
      <b class="text-red-500">{{$message}}</b>
      @enderror
    </div>
    <div>
      <x-label for="twitter_url" class="font-sans font-semibold" value="Url Twitter: "></x-label>
      <x-input class="block mt-1 w-full" type="text" name="twitter_url" value="{{$empresa->emp_url_twitter}}">
      </x-input>
      @error('twitter_url')
      <b class="text-red-500">{{$message}}</b>
      @enderror
    </div>
    <div>
      <x-label for="instagram_url" class="font-sans font-semibold" value="Url Instagram: "></x-label>
      <x-input class="block mt-1 w-full" type="text" name="instagram_url" value="{{$empresa->emp_url_instagram}}">
      </x-input>
      @error('instagram_url')
      <b class="text-red-500">{{$message}}</b>
      @enderror
    </div>
    <div>
      <x-label for="youtube_url" class="font-sans font-semibold" value="Url Youtube: "></x-label>
      <x-input class="block mt-1 w-full" type="text" name="youtube_url" value="{{$empresa->emp_url_youtube}}">
      </x-input>
      @error('youtube_url')
      <b class="text-red-500">{{$message}}</b>
      @enderror
    </div>

  </div>

  <div class="grid lg:grid-cols-2 gap-6 mt-4 ">
    <div class="w-full h-full flex space-y-2  items-center flex-col p-4 ">
      {{--  <div class="tipo-recorte w-full text-white flex justify-center items-center">
        <select
          class="bg-gray-300 text-gray-900 flex justify-center mt-2 px-10 py-2 rounded-lg focus:outline-none focus:shadow-outline"
          name="tipo_croppie_imagen" id="tipo_croppie_imagen">
          <option value="circle">Circular</option>
          <option value="square">Cuadrado</option>
        </select>
      </div> --}}
      <div class="container-image px-28 mt-4 py-6 flex justify-center items-center ">
        <div id="container-image" class="border border-solid border-black">
          {{--     <img src="{{$empresa->emp_logo}}" alt=""> --}}
          @if($empresa->emp_logo)
          <img src="{{$empresa->emp_logo}}" style="height: 100%; width:100%;" alt="Logo Empresa">
          @else
          <img src="{{asset('public/img/preview.png')}}" style="height: 100%; width:100%;" alt="Logo Empresa">
          @endif
          <div id="croppie_imagen"></div>
          <input type="hidden" name="result" id="croppie_result_imagen">
          <input type="hidden" name="razon" id="razon">
          <input type="hidden" name="url_croppie" id="url_croppie">
        </div>

      </div>
      <input id="image-file" class="hidden" type="file" accept="image/*" />
      <div class="flex space-x-1">
        <x-button id="btn-image" type="button"
          class="btn-aeurus upload-result bg-indigo-500  text-white font-sans font-bold ">
          Adjuntar imagen
        </x-button>
        <x-button id="btn-upload" type="button"
          class="btn-aeurus upload-result bg-indigo-500  text-white font-sans font-bold ">
          Subir imagen
        </x-button>
      </div>
    </div>
    <div>
      <x-label for="coords_map" class="font-sans font-semibold" value="Coordenadas mapa: "></x-label>
      <div class="flex w-full mt-1">
        <div class="w-full mr-2">
          <x-label for="coords_map" class="font-sans font-semibold" value="Latitud: "></x-label>
          <x-input class=" mt-1  mb-2 w-full " type="text" id="coords_map_lat" name="coords_map_lat"
            value="{{$empresa->emp_coords_lat}} " readonly></x-input>
        </div>
        <div class="w-full ml-2">
          <x-label for="coords_map" class="font-sans font-semibold" value="Longitud: "></x-label>
          <x-input class=" mt-1 w-full  mb-2" type="text" id="coords_map_lng" name="coords_map_lng"
            value="{{$empresa->emp_coords_lng}}" readonly></x-input>
        </div>

      </div>
      @error('coords_map')
      <b class="text-red-500">{{$message}}</b>
      @enderror
      <div id="map"></div>

    </div>
    {{--  <div class="flex flex-col items-center mt-5">
                <div id="upload-demo-i"></div>
          </div>       <x-button id="btn-image" 
                class="btn-aeurus upload-result hidden bg-indigo-500  text-white font-sans font-bold ">
                    Subir imagen
                </x-button>
        
               </div> --}}

  </div>


  <div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
      <div class="border-t border-gray-200"></div>
    </div>
  </div>


  <div class="flex items-center justify-end ">
    <x-button type="submit" class="ml-3 mt-2  bg-green-500  hover:bg-blue-500  text-white font-sans font-bold ">
      Actualizar
    </x-button>

  </div>

  </form>
</div>
</div>
<footer class="block py-4">
  <div class="container mx-auto px-4">
    <hr class="mb-4 border-b-1 border-blueGray-200" />
    <div class="flex flex-wrap items-center md:justify-between justify-center">
      <div class="w-full md:w-4/12 px-4">
        <div class="text-sm text-blueGray-500 font-semibold py-1 text-center md:text-left">
          Aeurus © <span id="get-current-year"></span>

        </div>
      </div>
      <div class="w-full md:w-8/12 px-4">
        <ul class="flex flex-wrap list-none md:justify-end justify-center">
          <li>
            <a href="https://www.creative-tim.com?ref=njs-settings"
              class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3">
              Creative Tim
            </a>
          </li>
          <li>
            <a href="https://www.creative-tim.com/presentation?ref=njs-settings"
              class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3">
              About Us
            </a>
          </li>
          <li>
            <a href="http://blog.creative-tim.com?ref=njs-settings"
              class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3">
              Blog
            </a>
          </li>
          <li>
            <a href="https://github.com/creativetimofficial/notus-js/blob/main/LICENSE.md?ref=njs-settings"
              class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3">
              MIT License
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>




@endsection

@section('scripts')

@if($errors->any())
<script>
    var message = @json($errors->first());
        console.log(message);

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: message
        })
</script>
@php Session::forget('errors') @endphp

@endif

<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCnvd0PUEZCZAVcZhQPISAjbFSJBJlsN8&callback=initMap&libraries=&v=weekly"
  async></script>
<script>
  //Crear toast para alertas
  const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
  })

  //valores por defecto google maps
  const latitud = parseFloat(@json($empresa->emp_coords_lat));
  const longitud = parseFloat(@json($empresa->emp_coords_lng));
  const id_empresa = @json($empresa->id);
</script>


<script src="{{asset('public/assets/js/maps.js')}}"></script>
<script src="{{asset('public/assets/js/croppie-emp.js')}}"></script>

<script>
  //click input file adjuntar imagen
$('#btn-image').on('click', function (e) {
    $('#image-file').click();
});


var corte_ancho_imagen = 1200;
var corte_alto_imagen = 600;

//preview imagen al seleccionar imagen 

$('#image-file').on('change', function (e) {
    var original = this;
    var image_original = this.files[0];
    var img;
    var result;
   /*  var corte_ancho_imagen = 800;
    var corte_alto_imagen = 600; */
    if (image_original) {

        //obtener nombre archivo y validar extension
        var file = image_original;
        var archivo_nombre = file.name.toString();
        var filename = archivo_nombre.split("\\").pop().split("/").pop();
        var ext = (filename.substr((Math.max(0, filename.lastIndexOf(".")) || Infinity) + 1));
        //validar extensiones archivo 
        if (!(ext == "jpg" || ext == "jpeg" || ext == "png" || ext == "gif" || ext == "svg")) {
            Toast.fire({
                icon: 'error',
                title: 'La extension debe ser jpg,jpeg,png,svg o gif'
            })
            throw new Error("La extension del archivo no es valida");
        }

        //extension validada
        //crear objeto tipo imagen

        img = new Image();
        img.onload = function () {
          if (this.width.toFixed(0) >= corte_ancho_imagen && this.height.toFixed(0) >= corte_alto_imagen) {
                    readURL(original);
                } else {
                    $(original).val("");
                    Toast.fire({
                          icon: 'error',
                          title: "Tamaño minimo: " + corte_ancho_imagen + "px x " + corte_alto_imagen + "px."
                    });
                    throw new Error("Tamaño minimo: " + corte_ancho_imagen + "px x " + corte_alto_imagen + "px.");
            }
            
        }
        img.src = URL.createObjectURL(image_original);
        console.log(img.src);
    }

});

function readURL(input) {

    if (input.files && input.files[0]) {
        console.log(input.files);
        //si input file contiene algun archivo
        //leer archivo
        var reader = new FileReader();
        reader.onload = function (e) {
            const url_base64 = e.target.result;
            $('#container-image img').remove();
            $('#container-image').append('<div id="croppie_imagen"></div>');
            $("#croppie_imagen").croppie('destroy');
            var razon;
                 if (corte_ancho_imagen > 1500) {
                    razon = 4;
                }else if(corte_ancho_imagen >= 500 && corte_ancho_imagen < 1500 ){
                    razon = 2;
                }else{
                    razon = 1;
                } 
         
            
            $("#croppie_imagen").croppie({
                viewport: {
                    width: corte_ancho_imagen /razon,
                    height: corte_alto_imagen/razon,
                    type: 'square',
                },
                url: url_base64,
                boundary: { //CONTENEDOR IMAGEN SUBIDA
                    width: (corte_ancho_imagen/razon)+30,
                    height: (corte_alto_imagen/razon)+30
                }
            });

            result = url_base64;
            $('#url_croppie').val(url_base64);
        }
        reader.readAsDataURL(input.files[0]);
    }
   
}

//click boton subir imagen

$('#btn-upload').on('click', function () {
     

    if($('#image-file').val() == ""){
      Toast.fire({
          icon: 'error',
          title: "No has adjuntado ninguna imagen"
      });
    }

    //mostrar imagen recortada y subir
    $("#croppie_imagen").croppie("result", {
        "type": "base64",
        "format": "jpeg|png|gif|jpg",
        "quality": 1
    }).then(function (img) {
        const url_croppie = $("#url_croppie").val();
        console.log(url_croppie);
        $.ajax({
            type: "POST",
            url: "{{route('empresa.cropImage')}}",
            data: {
                "image": img,
                "_token": "{{csrf_token()}}",
                "id": id_empresa,
            },
            success: function (data) {
              
              const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  });
                  //si tiene errores
                  if(data.error){
                      data.error.forEach(error => {
                        Toast.fire({
                            icon: 'error',
                            title: error
                        });
                      });
                  }else{
                      Toast.fire({
                          icon: 'success',
                          title: "imagen actualizada exitosamente"
                      });
                      html = ' <div id="croppie_imagen"><img src="' + data.img + '" /></div>'
                      $('#container-image #croppie_imagen').remove();
                      $('#container-image img').remove();
                      $('#container-image').append(html);
                      $('#logo_empresa').attr('src',data.img);
                  }
            },
            error: function(response){
                console.log(response);
                Toast.fire({
                        icon: 'error',
                        title: response.message
                })
            }
        });
    });
});


/*
$('#btn-image').on('click', function (e) {
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
var verifica_tamano = false;


$('#image-file').on('change', function (e) {


    //archivo
    const file = this.files[0];

    //validar tipo de archivo subido
    var archivo_nombre = file.name.toString();

    var filename = archivo_nombre.split("\\").pop().split("/").pop();
    var ext = (filename.substr((Math.max(0, filename.lastIndexOf(".")) || Infinity) + 1));

    if (!(ext == "jpg" || ext == "jpeg" || ext == "png" || ext == "gif")) {
        alert("formato no permitido");
        throw new Error("Ha ocurrido un error inesperado!");
    }


    var reader = new FileReader();

    var razon;
    if (corte_ancho_imagen > 1500) {
        razon = 4;
    } else if (corte_ancho_imagen >= 500 && corte_ancho_imagen < 1500) {
        razon = 2;
    } else {
        razon = 1;
    }
    reader.onload = function (e) {
        $("#croppie_imagen").remove();
        $('#container-image').empty();
        $("#container-image").append('<div id="croppie_imagen"></div>');

        //crear imagen
        const update = false;
        var img = new Image();
        img.onload = function () {

            if (this.width >= corte_ancho_imagen && this.height >= corte_alto_imagen) {
                verifica_tamano = true;
            } else {
                alert(`La imagen no cumple con el tamaño minimo de ${corte_ancho_imagen} x ${corte_alto_imagen}`);
                throw new Error("Ha ocurrido un error inesperado!");
            }
        }
        console.log(reader.result,e.target.result);
        img.src = reader.result;
        let url = e.target.result;
        $('#url_croppie').val(url);

        $('#razon').val(razon);


    }
    reader.readAsDataURL(this.files[0]);


});

$('#btn-upload').on('click', function (e) {
    e.preventDefault();
    if ($("#image-file").val() == "") {
        alert('Debe ingresar una imagen');
        return false;
    }
    const image = $("#image-file").val();

    $('#croppie_imagen').croppie('result',{
        type: 'canvas',
        size: 'viewport'
    }).then(function(res){
          $.ajax({
              type: "POST",
              url: "{{route('empresa.cropImage')}}",
              data: {
                  "image":  res,
                  "_token" : "{{csrf_token()}}",
                  "id" : id_empresa,
              },
              success: function (data) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  });
                  //si tiene errores
                  if(data.error){
                      data.error.forEach(error => {
                        Toast.fire({
                            icon: 'error',
                            title: error
                        });
                      });
                  }else{
                      Toast.fire({
                          icon: 'success',
                          title: "imagen actualizada exitosamente"
                      });
                      html = '<img src="' + res + '" style="height: 300px; width: 400px" />'
                      $('#container-image').html('');
                      $('#container-image').html(html)
                  }
              }
          });
    });


});



function initCroppie(corte_ancho_imagen, corte_alto_imagen, razon, url) {
    $('#croppie_imagen').croppie({
        //tamaño de recortador
        viewport: {
            width: corte_ancho_imagen / razon,
            height: corte_alto_imagen / razon,
            type: $("#tipo_croppie_imagen").val(),
        },
        url: url,
        /* enableResize: true,
        enableOrientation: true,
        mouseWheelZoombool: true,
        showZoomer: true,
        //tamaño del contenedor imagen
        boundary: {
            width: (corte_ancho_imagen / razon) + 30,
            height: (corte_alto_imagen / razon) + 30,
        }
    });
} */







</script>

{{-- <script>
  function imageData() {
  return {
    previewUrl: "",
    updatePreview() {
      var reader,
        files = document.getElementById("thumbnail").files;

      reader = new FileReader();

      reader.onload = e => {
        this.previewUrl = e.target.result;
      };

  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15,
    center: inicial,
  /*   mapTypeId: "terrain", */
  });
  // This event listener will call addMarker() when the map is clicked.
  map.addListener("click", (event) => {
    addMarker(event.latLng);
  });
  // Adds a marker at the center of the map.
  addMarker(inicial);
}
  };
}
</script> --}}

<!-- Alerta success actualizar empresa--->
@if(session('empresa_update'))
<script>
  var message = @json(session('empresa_update'));
        console.log(message);

        Toast.fire({
            icon: 'success',
            title: message
        })
</script>

@endif




@endsection