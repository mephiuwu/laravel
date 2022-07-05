@extends('layouts.admin')

@section('title')
 Detalle Contacto   
@endsection

@section('content')

<div class=" relative flex flex-row w-full bg-dark text-lg justify-start " style="height: 40px">
    <a href="{{route('contactos.index')}}">
        <x-button class="bg-indigo-500 h-10 w-90 hover:bg-gray-700  text-white font-sans font-bold">
            Volver</x-button>
    </a>
</div>

<div class="relative  flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded  bg-white">
   {{--  <div class="rounded-t mb-0 px-4 py-3 border-0">
        <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-lg text-blueGray-700">
                    Detalle Contacto
                </h3>
            </div>
        </div>
    </div> --}}
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Detalle de Contacto
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nombre
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$contacto->con_nombre}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Asunto
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$contacto->asunto->asun_nombre}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Email
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$contacto->con_email}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Teléfono
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$contacto->con_telefono}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Region
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$contacto->comuna->region->reg_nombre}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Comuna
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$contacto->comuna->comu_nombre}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Dirección
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$contacto->con_direccion}} 
                    </dd>
                </div>
                @if($contacto->con_path_documento)
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Adjuntos
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <!-- Heroicon name: solid/paper-clip -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">
                                     {{--    {{preg_replace('/&start=(\d+)/','',$contacto->con_path_documento)}} --}}
                                       {{--  {{str_replace(url('/documentos'),'',$contacto->con_path_documento)}} --}}
                                      {{--   {{str_replace(url('/documentos'),'',$contacto->con_path_documento)}} --}} 
                                      @php 
                                        $url = config('app.url')
                                      @endphp
                                        {{str_replace($url,'',$contacto->con_path_documento)}}
                                    </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{$contacto->con_path_documento}}" download="" target="_blank" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Descargar
                                    </a>
                                </div>
                            </li>
                         {{--    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <!-- Heroicon name: solid/paper-clip -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">
                                        coverletter_back_end_developer.pdf
                                    </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Download
                                    </a>
                                </div>
                            </li> --}}
                        </ul>
                    </dd>
                </div>
                @endif
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Mensaje
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$contacto->con_mensaje}}
                    </dd>
                </div>
            </dl>
        </div>
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


@endsection