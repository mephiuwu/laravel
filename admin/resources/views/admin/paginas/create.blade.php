@extends('layouts.admin')

@section('title')
 Crear Pagina editable   
@endsection

@section('content')



<a href="{{route('paginas.index')}}">
    <div class="flex flex-row w-full text-lg justify-start " style="height: 40px">
        <x-button id="btn-image"
            class="btn-aeurus bg-blue-500 w-100 ml-3 mt-2 absolute px-4 p-3 rounded-lg text-white font-sans font-bold float-right">
            Volver
        </x-button>
    </div>
</a>

<div class="relative  flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded  bg-white">
    <div class="rounded-t mb-0 px-4 py-3 border-0">
        <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-lg text-blueGray-700">
                    Crear Pagina
                </h3>
            </div>
        </div>
    </div>
    <div class="block w-full p-4  overflow-x-auto">
        <form action="{{route('paginas.store')}}" method="post">
            @csrf
            <div class="grid gap-6 py-2">
                <div>
                    <x-label for="titulo" class="font-sans font-semibold" value="Titulo de la Pagina: "></x-label>
                    <x-input class="block mt-1 w-full" type="text" name="titulo">
                    </x-input>
                    @error('titulo')
                    <b class="text-red-500">{{$message}}</b>
                    @enderror
                </div>
            </div>


            <div class="grid md:grid-cols-2 gap-6 py-2">
                <div>
                    <x-label for="estado" class="font-sans font-semibold" value="Estado: ">
                    </x-label>
                    <select name="estado"
                        class="w-full border-gray-300 h-11 mt-1 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"
                        placeholder="Seleccione un estado" required>
                        <option value="" selected disabled>Seleccione un estado</option>
                        <option value="1" @if(old('estado')==1) selected @endif>Activo</option>
                        <option value="0" @if(old('estado')==0) selected @endif>Inactivo</option>
                    </select>
                    @error('estado')
                    <b class="text-red-500">{{$message}}</b>
                    @enderror
                </div>
                <div>
                    <x-label for="orden" class="font-sans font-semibold" value="Orden: ">
                    </x-label>
                    <x-input class="block mt-1 w-full" placeholder="Ingrese el orden" type="number" name="orden">
                    </x-input>

                    @error('orden')
                    <b class="text-red-500">{{$message}}</b>
                    @enderror
                </div>
            </div>


            <div>
                <x-label for="contenido" class="font-sans font-semibold " value="Contenido de la pagina: ">
                </x-label>
                <textarea class="block  w-full" type="text" name="contenido"></textarea>
                @error('contenido')
                <b class="text-red-500">{{$message}}</b>
                @enderror
            </div>
            <div class="flex items-center mt-3 justify-center ">
                <x-button type="submit"
                    class="ml-3 mt-2  bg-green-500  hover:bg-blue-500  text-white font-sans font-bold ">
                    Crear Pagina
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
{{-- <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('contenido', {
            filebrowserUploadUrl: "{{ route('paginas.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            /* height: 400, */
            uiColor: '#5E82F3',
            fullPage: true,
            extraPlugins: 'docprops',
            // Disable content filtering because if you use full page mode, you probably
            // want to  freely enter any HTML content in source mode without any limitations.
            allowedContent: true,
    });

    CKEDITOR.contenido = function (config)
    {
        config.enterMode = CKEDITOR.ENTER_P;
        config.enterMode = CKEDITOR.ENTER_DIV;
        config.enterMode = CKEDITOR.ENTER_BR;
    };

      
</script>
 --}}

 <script src="{{asset('public/assets/js/ckeditor/ckeditor.js')}}"></script>

<script>
  CKEDITOR.replace('contenido',{
            filebrowserUploadUrl: "{{ route('paginas.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            /* height: 400, */
            uiColor: '#5E82F3',
            fullPage: true,
           
            // Disable content filtering because if you use full page mode, you probably
            // want to  freely enter any HTML content in source mode without any limitations.
            allowedContent: true,
  });    
</script> 


@endsection