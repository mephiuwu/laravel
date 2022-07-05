@php
$empresa = App\Models\Empresa::first();
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="google-site-verification" content="z0n0WMz7lYib3odk611vDEaCgZJNf0ijPu0JuGLIQus" />
    <link rel="shortcut icon" href="{{asset('public/favicon.ico')}}" />
  {{--   <link rel="icon" href="{{asset('public/favicon.ico')}}" type="image/x-icon"> --}}

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/assets/img/apple-icon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/styles/tailwind.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/assets/css/croppie.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/openlayers@4.6.5/dist/ol.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="{{asset('public/assets/css/fix.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/tooltip.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" />
    <title>{{$empresa->emp_razon_social}} | @yield('title')</title>
</head>

<body class="text-blueGray-700 antialiased overflow-auto"></body>
<div id="root">
    <nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
        <div
            class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
            <button
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                type="button" onclick="toggleNavbar('example-collapse-sidebar')">
                <i class="fas fa-bars"></i>
            </button>
            <a class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                href="{{ route('home') }}">
              
                @if($empresa->emp_logo == "aeurus.png")
                <img src="{{asset('public/aeurus.png')}}" alt="{{$empresa->emp_razon_social}}" id="logo_empresa"
                    style="height: 100%; max-height: 100px; text-align:center; min-height:20px; width: 100%; max-width: 200px;">
                @else
                <img src="{{$empresa->emp_logo}}" alt="{{$empresa->emp_razon_social}}" id="logo_empresa"
                    style="height: 100%; max-height: 100px; text-align:center; min-height:20px; width: 100%; max-width: 200px;">

                @endif
            </a>
            <ul class="md:hidden items-center flex flex-wrap list-none">
                <li class="inline-block relative">

                    <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                        id="notification-dropdown">
                        <a href="{{route('perfil.index')}}"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Mi
                            Perfil</a>
                        {{--     <a
                                href="#"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Another
                                action</a><a href="#"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Something
                                else here</a> --}}
                        <div class="h-0 my-2 border border-solid border-blueGray-100"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="route('logout')"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                                onclick="event.preventDefault();
                                      this.closest('form').submit();">
                                Cerrar sesión
                            </a>
                        </form>
                    </div>
                </li>
                <li class="inline-block relative">
                    <a class="text-blueGray-500 block" href="#"
                        onclick="openDropdown(event,'user-responsive-dropdown')">
                        <div class="items-center flex " style="height: 100%">
                            <span class="w-12 h-12 inline-flex min-h-full items-center justify-center rounded-full ">
                                @if(Auth::user()->profile_image )
                                <img class="w-full  rounded-full align-middle border-none shadow-lg"
                                    style="height: 100%; width:100%; object-fit:cover" id="profile_image"
                                    src="{{Auth::user()->profile_image}}" name="profile_image" width="46" height="46"
                                    alt="{{ Auth::user()->name }}" />
                                @else

                                <div class="profile_navbar">
                                    <span
                                        class="text-sm text-center empty-avatar rounded-full w-12 h-12 flex items-center justify-center text-white bg-green-200   ">{{strtoupper(Auth::user()->name[0])}}
                                    </span>
                                </div>

                                @endif
                            </span>
                        </div>
                    </a>
                    <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                        id="user-responsive-dropdown">
                        <a href="{{route('perfil.index')}}"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Mi
                            Perfil</a>
                        {{--     <a
                                href="#pablo"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Another
                                action</a><a href="#pablo"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Something
                                else here</a> --}}
                        <div class="h-0 my-2 border border-solid border-blueGray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                                onclick="event.preventDefault(); this.closest('form').submit();"><i
                                    class="fas fa-sign-out-alt mr-2 text-blue-900 text-base"></i>Cerrar sesión</a>
                        </form>
                    </div>
                </li>
            </ul>
            <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
                id="example-collapse-sidebar">
                <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200">
                    <div class="flex flex-wrap">
                        <div class="w-6/12">
                            <a class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                                href="../../index.html">
                                Aeurus
                            </a>
                        </div>
                        <div class="w-6/12 flex justify-end">
                            <button type="button"
                                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                onclick="toggleNavbar('example-collapse-sidebar')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <form class="mt-6 mb-4 md:hidden">
                    <div class="mb-3 pt-0">
                        <input type="text" placeholder="Search"
                            class="border-0 px-3 py-2 h-12 border border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal" />
                    </div>
                </form>
                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Heading -->
                <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                    Administración principal
                </h6>
                <!-- Navigation -->

                <ul class="md:flex-col md:min-w-full flex flex-col list-none">

                    <li class="items-center">
                        <a href="{{ route('home') }}"
                            class="text-xs uppercase py-3 font-bold block 
                                    {{ request()->routeIs('home') ? 'text-blue-700 hover:text-blueGray-900' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i class="fas fa-home mr-2 text-sm opacity-75"></i>
                            Inicio
                        </a>
                    </li>
                    <li class="items-center">
                        <a href="{{route('noticia.index')}}"
                            class="text-xs uppercase py-3 font-bold block 
                                {{ request()->routeIs('noticia.*') ? 'text-blue-700 hover:text-blueGray-900' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i class="fas fa-newspaper mr-2 text-sm text-blueGray-300"></i>
                            Noticias
                        </a>
                    </li>

                    <li class="items-center">
                        <a href="{{route('sliders.index')}}"
                            class="text-xs uppercase py-3 font-bold block  {{ request()->routeIs('sliders.*') ? 'text-blue-700 hover:text-blueGray-900' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i class="fas fa-images mr-2 text-sm text-blueGray-300"></i>
                            Sliders
                        </a>
                    </li>

                    <li class="items-center">
                        <a href="{{route('paginas.index')}}"
                            class="text-xs uppercase py-3 font-bold block  {{ request()->routeIs('paginas.*') ? 'text-blue-700 hover:text-blueGray-900' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i class="fas fa-desktop mr-2 text-sm text-blueGray-300"></i>
                            {{--  <i class="fas fa-images mr-2 text-sm text-blueGray-300"></i> --}}
                            Paginas editables
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Heading -->
                <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                    Gráficos y documentos
                </h6>
                <!-- Navigation -->

                <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
                    <li class="items-center" x-data="{open: false}">
                        <a href="#" x-on:click="open=!open" :class="{'text-blue-700 hover:text-blue-900': open}"
                            class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block
                            {{ request()->routeIs('contactos.*') ? 'text-blue-700 hover:text-blueGray-900' : 'text-blueGray-700 hover:text-blueGray-500' }}">

                            <i class="fas fa-address-book text-blueGray-300 mr-2 text-sm"></i>
                            Contactos
                            <i class="fas text-blueGray-700  ml-3 text-sm" id="arrow-icon"
                                :class="{'fa-arrow-right': !open,'fa-arrow-down': open}"></i>

                        </a>

                        <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4" x-show="open">
                            <li class="items-center">
                                <a href="{{route('contactos.index')}}"
                                    class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block">
                                    <i class="fas fa-address-book text-blueGray-300 mr-2 ml-2 text-sm"></i>
                                    Listado de contactos
                                </a>
                            </li>
                            @if(Auth::user()->rol->rol_name == 'Admin' )
                            <li class="items-center">
                                <a href="{{route('contactos.grafico')}}"
                                    class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block">
                                    <i class="fas fa-chart-pie text-blueGray-300 mr-2 ml-2 text-sm"></i>
                                    Estadisticas de los contactos
                                </a>
                            </li>
                            @endif

                        </ul>
                    </li>


                </ul>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Heading -->
                <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                    Otros
                </h6>
                <!-- Navigation -->

                <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
                    @if(Auth::user()->rol->rol_name == 'Admin' )
                    <li class="items-center">
                        <a href="{{route('empresa.index')}}" class="text-xs uppercase py-3 font-bold block 
                        {{ request()->routeIs('empresa.*') ? 'text-blue-700 hover:text-blueGray-900' 
                        : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i class="fas fa-building text-blueGray-300 mr-2 text-sm"></i>
                            Configurar Empresa
                        </a>
                    </li>


                    <li class="items-center">
                        <a href="{{ route('usuarios.index') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('usuarios.*') ? 'text-blue-700 hover:text-blueGray-900' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i class="fas fa-user-circle text-blueGray-300 mr-2 text-sm"></i>
                            Administrar usuarios
                        </a>
                    </li>
                    @endif
                    <li class="items-center">
                        <a href="{{ route('asuntos.index') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('asuntos.*') ? 'text-blue-700 hover:text-blueGray-900' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i class="fas fa-tasks text-blueGray-300 mr-2 text-sm"></i>
                            Administrar asuntos
                        </a>
                    </li>

                    {{--  <li class="items-center">
                            <a href="../profile.html" class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block">
                                <i class="fas fa-address-book text-blueGray-300 mr-2 text-sm"></i>
                                Administrar contactos
                            </a>
                        </li> --}}
                </ul>
                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                @if(Auth::user()->id == 1 )
                <!-- Heading -->
                <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                    Seguridad
                </h6>
                <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
                    <li class="items-center">
                        <a href="{{route('logs.index')}}" class="text-xs uppercase py-3 font-bold block 
                        {{ request()->routeIs('logs.*') ? 'text-blue-700 hover:text-blueGray-900' 
                        : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i class="fas fa-building text-blueGray-300 mr-2 text-sm"></i>
                            Logs
                        </a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </nav>
    <div class="relative md:ml-64 bg-blueGray-50 min-h-screen">
        <nav
            class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
            <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
                <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" target="_blank"
                    href="{{config('app.url_sitio')}}"><i
                        class="fas fa-arrow-left text-blueGray-300 mr-2 text-sm"></i>Ir a
                    página principal</a>
                {{--    <form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
                        <div class="relative flex w-full flex-wrap items-stretch">
                            <span
                                class="z-10 h-full leading-snug font-normal text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"><i
                                    class="fas fa-search"></i></span>
                            <input type="text" placeholder="Buscar..."
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10" />
                        </div>
                    </form> --}}
                <div class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
                    <h2 class="text-white text-lg font-bold font-sans">Hola, {{Auth::user()->name}}</h2>
                </div>

                <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
                    <a class="text-blueGray-500 block" href="#" onclick="openDropdown(event,'user-dropdown')">
                        <div class="items-center flex object-contain h-full w-full">
                            <span class="w-12 h-12 inline-flex items-center bg-white justify-center rounded-full ">
                                @if(Auth::user()->profile_image )
                                <img class="w-full  rounded-full align-middle border-none shadow-lg"
                                    style="height: 100%; width:100%; object-fit:cover"
                                    src="{{Auth::user()->profile_image}}" name="profile_image" width="46" height="46"
                                    id="profile_image" alt="{{ Auth::user()->name }}" />
                                @else
                                <div class="flex justify-center w-full">
                                    <div class="profile_navbar">
                                        <span
                                            class="text-sm text-center empty-avatar rounded-full w-12 h-12 flex items-center justify-center text-white bg-green-200   ">{{strtoupper(Auth::user()->name[0])}}
                                        </span>
                                    </div>
                                </div>
                                @endif
                            </span>

                            {{--                                     <img alt="..." class="w-full rounded-full align-middle border-none shadow-lg" src="../../assets/img/team-1-800x800.jpg" />
                                        --}}
                        </div>
                    </a>
                    <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                        id="user-dropdown">
                        <a href="{{route('perfil.index')}}"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Mi
                            Perfil</a>
                        {{--      <a
                                href="#"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Another
                                action</a><a href="#"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Something
                                else here</a> --}}
                        <div class="h-0 my-2 border border-solid border-blueGray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                                onclick="event.preventDefault(); this.closest('form').submit();"><i
                                    class="fas fa-sign-out-alt mr-2 text-blue-900 text-base"></i>Cerrar sesión</a>
                        </form>
                    </div>
                </ul>
            </div>
        </nav>
        <!-- Header -->
        <div class="relative bg-blue-900 md:pt-32 pb-32 pt-12 ">
            <div class="px-4 md:px-10 mx-auto w-full ">

            </div>

        </div>
        <div class="px-4 md:px-10 mx-auto w-full -m-24 ">
            @yield('content')

            {{--   <footer class="block py-4 bottom-0 ">
                    <div class="container mx-auto px-4">
                        <hr class="mb-4 border-b-1 border-blueGray-200" />
                        <div class="flex flex-wrap w-full items-center md:justify-between justify-center">
                            <div class="w-full md:w-4/12 px-4">
                                <div class="text-sm text-blueGray-500 font-semibold py-1 text-center md:text-left">
                                    Aeurus © <span id="get-current-year"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </footer> --}}

        </div>


    </div>

</div>
{{--  <div class="px-4 md:px-10 mx-auto w-full -m-24 mb-auto">
    @yield('content')

    <footer class="block py-4 bottom-0 ">
      <div class="container mx-auto px-4">
        <hr class="mb-4 border-b-1 border-blueGray-200" />
        <div class="flex flex-wrap w-full items-center md:justify-between justify-center">
          <div class="w-full md:w-4/12 px-4">
            <div class="text-sm text-blueGray-500 font-semibold py-1 text-center md:text-left">
              Aeurus © <span id="get-current-year"></span>
            </div>
          </div>
        
        </div>
      </div>
    </footer>
 --}}

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="{{asset('public/assets/js/validarRut.js')}}"></script>
<script src="https://unpkg.com/openlayers@4.6.5/dist/ol.js"></script>
<script src="{{asset('public/assets/js/croppie.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2/dist/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
    /* Make dynamic date appear */
        (function() {
            if (document.getElementById("get-current-year")) {
                document.getElementById(
                    "get-current-year"
                ).innerHTML = new Date().getFullYear();
            }
        })();
        /* Sidebar - Side navigation menu on mobile/responsive mode */
        function toggleNavbar(collapseID) {
            document.getElementById(collapseID).classList.toggle("hidden");
            document.getElementById(collapseID).classList.toggle("bg-white");
            document.getElementById(collapseID).classList.toggle("m-2");
            document.getElementById(collapseID).classList.toggle("py-3");
            document.getElementById(collapseID).classList.toggle("px-6");
        }
        /* Function for dropdowns */
        function openDropdown(event, dropdownID) {
            let element = event.target;
            while (element.nodeName !== "A") {
                element = element.parentNode;
            }
            Popper.createPopper(element, document.getElementById(dropdownID), {
                placement: "bottom-start",
            });
            document.getElementById(dropdownID).classList.toggle("hidden");
            document.getElementById(dropdownID).classList.toggle("block");
        }
        
</script>

@yield('scripts')



</body>

</html>