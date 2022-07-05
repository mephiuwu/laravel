@extends('layouts.admin')

@section('title')
 Crear Noticia   
@endsection

@section('content')
    <style>
        bolita-obligatoria {
            color: red;
        }

    </style>
    <div class=" relative flex flex-row w-full bg-dark text-lg justify-start " style="height: 40px">
        <a href="{{ route('noticia.index') }}">
            <x-button class="bg-indigo-500 h-10 w-90 hover:bg-gray-700  text-white font-sans font-bold">
                Volver</x-button>
        </a>
    </div>
    <div class="relative  flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded  bg-white">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-2xl mt-3 text-blueGray-700">
                        Registrar noticia
                    </h3>
                </div>
            </div>
        </div>
        <div class="block w-full p-4 overflow-x-auto">
            <form action="{{ route('noticia.store') }}" method="post">
                @csrf
                <div class="grid md:grid-cols-1 gap-6">
                    <div>
                        <x-label for="titulo" class="font-sans font-semibold">Título (<bolita-obligatoria>*
                            </bolita-obligatoria>) : </x-label>
                        <x-input class="block mt-1 w-full" type="text" value="{{old('titulo')}}" placeholder="Ingrese el título" name="titulo"
                            required>
                        </x-input>
                    </div>
                    @error('titulo')
                        <b class="text-red-500">{{ $message }}</b>
                    @enderror
                </div>
                <br>
                <div class="grid md:grid-cols-1 gap-6">
                    <div>
                        <x-label for="fecha" class="font-sans font-semibold">Fecha (<bolita-obligatoria>*
                            </bolita-obligatoria>) : </x-label>
                        <x-input class="block mt-1 w-full" type="date" value="{{old('fecha')}}" placeholder="Ingrese fecha" name="fecha" required>
                        </x-input>
                    </div>
                    @error('fecha')
                        <b class="text-red-500">{{ $message }}</b>
                    @enderror
                </div>
                <br>
                <div class="grid md:grid-cols-1 gap-6">
                    <div>
                        <x-label for="resumen" class="font-sans font-semibold">Resumen (<bolita-obligatoria>*
                            </bolita-obligatoria>) : </x-label>

                     {{--    <div class="bg-yellow-100 border border-orange-400 text-yellow-700 px-4 py-3 mt-1 mb-2 rounded relative"
                            role="alert">
                            <strong class="font-bold">¡Información!</strong>
                            <span class="block sm:inline">Algunos contenidos ingresados dentro del editor de texto pueden
                                afectar la visualización
                                responsiva del sitio web</span>
                        </div> --}}
                        <textarea style="max-width: 100%; min-width: 100%; min-height: 100px;" class="resize border border-gray-300 rounded-md block mt-1 w-full p-3" rows="4"
                            placeholder="Escriba un resumen" name="resumen" required>{{old('resumen')}}</textarea>
                    </div>
                    @error('resumen')
                        <b class="text-red-500">{{ $message }}</b>
                    @enderror
                </div>
                <br>
                <div class="grid md:grid-cols-1 gap-6">
                    <div>
                        <x-label for="descripcion" class="font-sans font-semibold mb-2">Contenido (<bolita-obligatoria>*</bolita-obligatoria>) : </x-label>
                      {{--   <div class="bg-yellow-100 border border-orange-400 text-yellow-700 px-4 py-3 mt-1 mb-2 rounded relative"
                            role="alert">
                            <strong class="font-bold">¡Información!</strong>
                            <span class="block sm:inline">Algunos contenidos ingresados dentro del editor de texto pueden
                                afectar la visualización
                                responsiva del sitio web</span>
                        </div> --}}
                        <textarea  class="resize border border-gray-300 rounded-md block mt-1 w-full p-3"
                         name="contenido"
                            id="contenido" required>{{old('contenido')}}</textarea>
                    </div>
                    @error('contenido')
                        <b class="text-red-500">{{ $message }}</b>
                    @enderror
                </div>
                <br>
                <div class="grid md:grid-cols-1 gap-6">
                    <x-label for="estado" class="font-sans font-semibold" style="margin-bottom: -20px">Estado (<bolita-obligatoria>*</bolita-obligatoria>) :
                    </x-label>
                    <select name="estado"
                        class="w-full border-gray-300 h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"
                        placeholder="Seleccione un estado" required>
                        <option value="" selected disabled>Seleccione un estado</option>
                        <option value="1" @if(old('estado') == 1) selected @endif>Activo</option>
                        <option value="0" @if(old('estado') == 0) selected @endif>Inactivo</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    </div>
                    @error('estado')
                        <b class="text-red-500">{{ $message }}</b>
                    @enderror
                </div>
                <br>

                <div class="flex items-center justify-end ">
                    <x-button class="ml-3 mt-2 bg-indigo-500 h-10 w-90 hover:bg-gray-700  text-white font-sans font-bold "
                        id="crearNoticia">
                        Registrar noticia
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
                        Copyright © <span id="get-current-year"></span>
                        <a href="https://www.creative-tim.com?ref=njs-settings"
                            class="text-blueGray-500 hover:text-blueGray-700 text-sm font-semibold py-1">
                            Creative Tim
                        </a>
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

<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace('contenido', {
           
            editorplaceholder: 'Escribe la descripción aquí...',
            filebrowserUploadUrl: "{{ route('noticia.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
</script>

@endsection
