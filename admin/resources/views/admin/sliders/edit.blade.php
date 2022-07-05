@extends('layouts.admin')

@section('title')
 Editar Slider   
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
  #FileUpload.active {
  @apply shadow-outline-blue border-blue-300;
  box-shadow: 0 0 0 3px rgba(164, 202, 254, 0.45);
  border-color: #a4cafe;
}
</style>


<a href="{{route('sliders.index')}}">
    <div class="flex flex-row w-full text-lg justify-end " style="height: 40px">
        <x-button id="btn-back"
            class="btn-aeurus bg-blue-500 w-100 ml-3 mt-2 absolute px-4 p-3 rounded-lg text-white font-sans font-bold float-left">
            Volver
        </x-button>
    </div>
</a>
<div class="relative flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded  bg-white">
  <div class="rounded-t mb-0 px-4 py-3 border-0">
    <div class="flex flex-wrap items-center">
      <div class="relative w-full px-4 max-w-full flex-grow flex-1">
        <h3 class="font-semibold text-lg text-blueGray-700">
         Editar Slider
        </h3>
      </div>
    </div>
  </div>
  <div style="min-height:calc(70vh - 80px); " class="block w-full p-4 overflow-x-auto">
   <form action="{{route('slider.update',$slider->id)}}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PUT')
    <div class="grid lg:grid-cols-3 gap-6">
        <div>
          <x-label for="sli_nombre" class="font-sans font-semibold" value="Nombre : "></x-label>
          <x-input class="block mt-1 w-full" value="{{$slider->sli_nombre}}" type="text" name="sli_nombre" >
          </x-input>
          @error('sli_nombre')
          <b class="text-red-500">{{$message}}</b>
          @enderror
        </div>
        <div>
          <x-label for="sli_orden" class="font-sans font-semibold" value="Orden: ">
          </x-label>
          <x-input class="block mt-1 w-full" type="number" min="1" value="{{$slider->sli_orden}}" name="sli_orden" placeholder="Ingrese el orden del slider" >
          </x-input>
         {{--  <select class="w-full  text-gray-900 mt-2 py-1 px-2 rounded-lg focus:outline-none focus:shadow-outline"
          name="sli_orden" id="sli_orden">
             <option value="">Seleccione una opción</option>
            @forelse ($sliders_activos as $activo)
            <option value="{{$activo->sli_orden}}"
             @if($slider->sli_orden == $activo->sli_orden) selected @endif    
            {{old('sli_orden') == $activo->sli_orden ? 'selected' : ''}} >
                {{$activo->sli_orden}}
            </option>
            @empty
            <option value="1">1</option>
            @endforelse
            
            
         </select> --}}
          @error('sli_orden')
          <b class="text-red-500">{{$message}}</b>
          @enderror
        </div>
        <div>
            <x-label for="sli_estado" class="font-sans font-semibold" value="Estado : "></x-label>
            <select class="w-full  text-gray-900 mt-2 py-1 px-2 rounded-lg focus:outline-none focus:shadow-outline"
          name="sli_estado" id="sli_estado">
             <option value="">Seleccione una opción</option>
             <option value="1"   @if($slider->sli_estado == "1") selected @endif>Activo</option>
             <option value="0"  @if($slider->sli_estado == "0") selected @endif>Inactivo</option>
         </select>
         @error('sli_estado')
         <b class="text-red-500">{{$message}}</b>
         @enderror
        </div>
  </div>

  <div >
  
   
     <div class="px-4 py-6 sm:px-0 border-black border-solid" id="croppie-container">
        <input type="file" id="input-image" name="input-image"
        class="relative inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
        >
        <input type="hidden" id="url_croppie"  name="url-image"
        class="relative inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
        >
        <div {{-- onclick="updatePreview()" --}} class="px-10 "  style="height:300px; width: 100%; object-fit:contain" id="container-preview" >
            <div id="croppie_imagen" style="height:100%; width: 100%;">
             <img src="{{$slider->sli_path}}" alt="{{$slider->sli_nombre}}" style="height:100%; width: 100%;"  >
            </div>
        </div>

      </div>
   
   
</div>
<div class="flex justify-center space-x-1">
   {{--  <x-button id="btn-image" type="button"
    class="btn-aeurus upload-result bg-indigo-500  text-white font-sans font-bold ">
    Adjuntar imagen
    </x-button> --}}
    <x-button id="btn-upload" type="button"
    class="btn-aeurus hidden  upload-result bg-indigo-500  text-white font-sans font-bold ">
     Actualizar Imagen
    </x-button>
    <x-button id="btn-delete" type="button"
    class="btn-aeurus bg-red-500  text-white font-sans font-bold ">
     Borrar Imagen
    </x-button>
    <input type="hidden" id="path_recorte_image"  name="path_recorte_image"
    class="relative inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
    >
  
</div>
<div class="flex justify-end">
  <x-button id="btn-submit" type="submit"
  class="btn-aeurus  upload-result bg-indigo-500 hover:bg-green-500  text-white font-sans font-bold ">
   Actualizar Slider
  </x-button>
</div>

</form>  
</div>

</div>
<footer class="block py-4 mb-auto">
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
<script src="{{asset('public/assets/js/croppie.js')}}"></script>

 <script>
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
 </script>


@if(session('slider_success'))
<script>
var message = @json(session('slider_success'));
        console.log(message);

        Toast.fire({
            icon: 'success',
            title: message
        })
</script>
@php Session::forget('slider_success') @endphp

@endif

@if(session('slider_error'))
<script>
var message = @json(session('slider_error'));
        console.log(message);

        Toast.fire({
            icon: 'danger',
            title: message
        })
</script>
@php Session::forget('slider_error') @endphp

@endif

@if($errors->any())
<script>
      var message = @json($errors->first());
        console.log(message);

        Toast.fire({
            icon: 'error',
            title: message
        })
</script>
@php Session::forget('errors') @endphp

@endif


<script>
   

  


    function updatePreview(){
        $('#input-image').click();
    }
    var corte_ancho_imagen = 1370;
    var corte_alto_imagen = 470;    
    $('#input-image').on('change',function(){
      
        var original = this;
        var image_original = this.files[0];
        var img;
        var result;

        if(image_original){
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
        }

        img = new Image();
        img.onload = function () {
          if (this.width.toFixed(0) >= corte_ancho_imagen && this.height.toFixed(0) >= corte_alto_imagen) {
                    readURL(original);
                } else {
                    $(original).val("");
                    Toast.fire({
                          icon: 'error',
                          title: "Tamaño minimo: " + corte_ancho_imagen + "px X " + corte_alto_imagen + "px."
                    });
                    throw new Error("Tamaño minimo: " + corte_ancho_imagen + "px X " + corte_alto_imagen + "px.");
            }
            
        }
        img.src = URL.createObjectURL(image_original);
        console.log(img.src);
    });


    function readURL(input){
        
    if (input.files && input.files[0]) {
        console.log(input.files);
        //si input file contiene algun archivo
        //leer archivo
        var reader = new FileReader();
        reader.onload = function (e) {
            const url_base64 = e.target.result;
         /*    $('#container-preview img').remove(); */
            $('#container-preview').remove();
            $('#croppie-container').append(`
            <div   style="height:100%; width: 100%;" id="container-preview" >
                <div id="croppie_imagen" style="height:100%; width: 100%;"></div>
            </div>
            `);
            $('#btn-upload').removeClass('hidden');
            $('#btn-delete').removeClass('hidden');
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
    
    $('#btn-upload').on('click',function(){
        $("#croppie_imagen").croppie("result", {
        "type": "base64",
        "format": "jpeg|png|gif|jpg",
        "quality": 1
      }).then(function (img) {
          const url_croppie = $("#url_croppie").val();
          console.log(url_croppie);
          $.ajax({
              type: "POST",
              url: "{{route('slider.cropImage')}}",
              data: {
                  "image": img,
                  "_token": "{{csrf_token()}}",
              },
              success: function(data){
                html = `
                <div id="container-preview" style="height:100%; width: 100%;" class="border-4 border-dashed flex flex-col border-gray-200 rounded-lg h-52 items-center justify-center ">
                  <div id="croppie_imagen" style="height:100%; width: 100%;">
                    <img src="${data.img}" style="height:100%; width: 100%;" />
                  </div>
                </div>`;
                $('#container-preview').remove();
                $('#container-preview img').remove();
                $('#croppie-container').append(html);
                $('#btn-upload').addClass('hidden');
                $('#path_recorte_image').val(data.img);
              }
          });        

        
    });
    });

    $('#btn-delete').on('click',function(){
        $('#container-preview').remove();
        $('#croppie-container').append(`
            <div onclick="updatePreview()" id="container-preview" class="border-4 border-dashed flex flex-col border-gray-200 rounded-lg h-52 cursor-pointer  items-center justify-center ">
                <h1 class="font-bold text-3xl text-center">
                    Vista previa
                </h1>
                <div class="flex text-center text-2xl ">
                    Presiona para subir una imagen
                </div>
            </div>
        `);
        $('#input-image').val('');
        $('#url_croppie').val('');
        $('#btn-upload').addClass('hidden');
        $('#btn-delete').addClass('hidden');
       });
   
</script>


@endsection