<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Aeurus</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

  <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro|Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('public/assets/css/main.scss')}}">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">

</head>

<body class="overflow-y-auto">

  <!---Navbar --->
  <div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <nav class="bg-gray-300 " x-data="{ open:false }" > <!-- ventana usuario cerrada  -->
      <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">

          <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
            <!-- Mobile menu button-->
            <button type="button"  x-on:click="open=true"  
              class="inline-flex items-center justify-center p-2 rounded-md text-dark hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
              aria-controls="mobile-menu" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <!--
            Icon when menu is closed.

            Heroicon name: outline/menu

            Menu open: "hidden", Menu closed: "block"
          -->
              <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              <!--
            Icon when menu is open.

            Heroicon name: outline/x

            Menu open: "block", Menu closed: "hidden"
          -->
              <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-between">
            <div class="flex-shrink-0 flex items-center">
              <a href="{{route('home')}}"> <img class="block lg:hidden h-8 w-auto" src="{{asset('public/img/aeurus.png')}}"
                  alt="Workflow"></a>
              <a href="{{route('home')}}"><img class="hidden lg:block h-8 w-auto" src="{{asset('public/img/aeurus.png')}}"
                  alt="Workflow"></a>
              {{--    <img class="hidden lg:block h-8 w-auto"
                src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow"> --}}
            </div>
            <div class="hidden sm:block sm:ml-6">
              <div class="flex space-x-4">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="bg-blue-700 text-white px-3 py-2 rounded-md text-sm font-medium"
                  aria-current="page">Home</a>
                <a href="#"
                  class="text-dark  hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium font-semibold ">Quienes
                  somos</a>
                <a href="#"
                  class="text-dark  hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium font-semibold">Noticias</a>
                <a href="#"
                  class="text-dark  hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium font-semibold">Servicios</a>
                <a href="#"
                  class="text-dark  hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium font-semibold">Documentos</a>
                <a href="#"
                  class="text-dark  hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium font-semibold">Contáctenos</a>
              </div>
            </div>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            {{-- <button
              class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
              <span class="sr-only">View notifications</span>
              <!-- Heroicon name: outline/bell -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
              </svg>
            </button> --}}
            @guest
      <!--     <div class="ml-3"> <a href="{{route('login')}}"  
            class="text-dark border border-gray-900 hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium font-semibold">Iniciar
            Sesion</a></div>  -->
            <div class="ml-3 relative border " x-data="{ open:false }"> <!--- ventana usuario cerrada --->
               <a href="{{route('login')}}" >Login</a>
            <!-- Profile dropdown -->
            @endguest
            @auth
            <div class="ml-3 relative" x-data="{ open:false }"> <!--- ventana usuario cerrada --->
              <div>
                <button type="button"
                  class="flex text-sm hover:text-blue-700 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                  x-on:click="open=true"> <!-- abrir ventana usuario ---->
                  <i class="fas fa-user" style="font-size: 24px" ></i>
                </button>
              </div>
              @endauth
              <!--
            Dropdown menu, show/hide based on menu state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          --> 
               <!--- contenido venta usuario abierta, si se hace click en cualquier parte se cierra ----->
              <div x-show="open" x-on:click.away="open=false" 
                class="origin-top-right absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <!-- Active: "bg-gray-100", Not Active: "" -->
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                  id="user-menu-item-0">Mi Perfil</a>
                @if(Auth::check() && Auth::user()->rol_id === 1)
                <a href="{{route('admin')}}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                  id="user-menu-item-0">Administración</a>
                @endif
                {{--   <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                  id="user-menu-item-1">Settings</a> --}}
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="route('logout')" onclick="event.preventDefault();
                            this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700"
                    role="menuitem" tabindex="-1" id="user-menu-item-2">Cerrar Sesión</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Mobile menu, show/hide based on menu state. -->
      <div class="sm:hidden " id="mobile-menu" x-show="open" x-on:click.away="open=false"   >
        <div class="px-2 pt-2 pb-3 space-y-1" >
          <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
          <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium"
            aria-current="page">Home</a>

          <a href="#" 
            class="text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Quienes somos</a>

          <a href="#"
            class="text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Noticias</a>

          <a href="#"
            class="text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Servicios</a>
            <a href="#"
            class="text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Documentos</a>
            <a href="#"
            class="text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Contacto</a>
        </div>
      </div>
    </nav>

    {{-- <header class="bg-white shadow">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
              Dashboard
            </h1>
          </div>
        </header> --}}
    <main>
      <div class="max-w-7xl sm:px-6 ">
        <!-- Replace with your content -->
        @yield('content')
        <!-- /End replace -->
      </div>
    </main>
    <div class="w-full">
      <div class="w-full bg-blue-800 text-white">
          <div class="xl:px-40 pb-12 lg:px-20 md:px-10 sm:px-5 px-10">
              <div class="w-full pt-12 flex flex-col sm:flex-row space-y-2  justify-start">
                  <div class="w-full sm:w-2/5 pr-6 flex flex-col space-y-4">
                     {{--  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="160" height="57" viewBox="0 0 160 57">
                          <defs>
                              <pattern id="pattern" preserveAspectRatio="none" width="100%" height="100%" viewBox="0 0 197 70">
                              <image width="197" height="70" xlink:href="data:image/png;base64,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"/>
                              </pattern>
                          </defs>
                          <rect id="ETI-Logo" width="160" height="57" fill="url(#pattern)"/>
                      </svg>  --}}
                      <img src="{{asset('public/img/logo-footer.png')}}" style="width: 175px; height: 35px;" alt="logo footer" srcset="">
                   <p class="opacity-60"><i class="fas fa-map-marker-alt"></i> San Martín 553, Of 1302, Concepción, Chile.</p>  
                   <p class="opacity-60"><i class="fas fa-phone"></i> +569 87654321</p>             
                  </div>
                  <div class="w-full sm:w-1/5 flex flex-col space-y-4">
                      <a href="#" class="opacity-60">Quienes somos</a>
                      <a href="#" class="opacity-60">Noticias</a>
                      <a href="#" class="opacity-60">Servicios</a>
                      <a href="#" class="opacity-60">Documentos</a>
                      
                  </div>
                  <div class="w-full sm:w-1/5 flex flex-col space-y-4">
                      <a href="#" class="opacity-60">Contacto</a>
                      <a href="#" class="opacity-60">Testimonios</a>
                      <a href="#" class="opacity-60">Politicas de privacidad</a>
                      <a href="#" class="opacity-60">Terminos de uso</a>
                  </div>
                  <div class="w-full sm:w-1/5 pt-6 flex items-end mb-1">
                      <div class="flex flex-row space-x-4">
                          <i class="fab fa-facebook-f"></i>
                          <i class="fab fa-twitter"></i>
                          <i class="fab fa-instagram"></i>
                          <i class="fab fa-google"></i>
                      </div>
                  </div>
              </div>
              <div class="opacity-60 pt-2">
                  <p>© 2021 Aeurus.</p>
              </div>
          </div>
      </div>
  </div>
  </div>

  <!-- Fin navbar --->
  <script src="https://unpkg.com/stimulus/dist/stimulus.umd.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="https://kit.fontawesome.com/4db6b32bd3.js" crossorigin="anonymous"></script>

  @yield('scripts')
</body>

</html>