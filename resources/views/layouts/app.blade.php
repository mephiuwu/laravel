@php
$empresa = App\Models\Empresa::first();
$paginas = App\Models\Pagina::where('pag_estado',1)->orderBy('pag_orden','ASC')->take(3)->get();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{$empresa->emp_meta_description}}">
    <meta name="keywords" content="{{$empresa->emp_meta_keywords}}">
    <meta name="title" content="{{$empresa->emp_meta_title}}" />
    <title>{{$empresa->emp_razon_social}} |  @yield('title')</title>
    {!! $empresa->emp_analytics !!}
    <link rel="icon" href="{{asset('public/favicon.ico')}}" type="image/x-icon">

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
        <nav class="bg-gray-300 " x-data="{ open:false }" >
          
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-20">

                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                        <button type="button" x-on:click="open=!open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-dark hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                            aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
           
                            <svg class=" h-6 w-6" xmlns="http://www.w3.org/2000/svg" x-show="!open" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
          
                            <svg class=" h-6 w-6" x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 flex items-center justify-center sm:items-center sm:justify-between">
                        <div class="flex-shrink-0 flex items-center ">
                            <a href="{{route('home')}}"> <img class="block lg:hidden h-auto w-auto "
                                    src="{{$empresa->emp_logo}} {{-- {{asset('img/aeurus.png')}} --}}"
                                    style="width: 150px" alt="Logo"></a>
                            <a href="{{route('home')}}"><img class="hidden lg:block h-auto  w-auto"
                                    src="{{$empresa->emp_logo}}" style="width: 150px" alt="Logo"></a>
                        </div>
                        <div class="hidden sm:block sm:ml-6 ">
                            <div class="flex space-x-4 ">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="{{route('home')}}"
                                    class="px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('home') ? 'text-white bg-blue-700' : 'text-dark hover:bg-blue-700 hover:text-white' }}"
                                    aria-current="page">Home</a>
                                @foreach($paginas as $pagina)
                              
                                <a href="{{route('pagina.customPage',$pagina->pag_slug)}}"
                                    class="px-3 py-2 rounded-md text-sm font-semibold {{ request()->segment(2) == $pagina->pag_slug ? 'text-white bg-blue-700' : 'text-dark hover:bg-blue-700 hover:text-white' }}"
                                    aria-current="page">{{$pagina->pag_nombre}}</a>
                                @endforeach
                                <a href="{{route('noticias.index')}}"
                                    class="px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('noticias.*') ? 'text-white bg-blue-700' : 'text-dark hover:bg-blue-700 hover:text-white' }}">Noticias</a>

                                <a href="{{route('contacto.index')}}"
                                    class="px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('contacto.*') ? 'text-white bg-blue-700' : 'text-dark hover:bg-blue-700 hover:text-white' }}">Contáctenos</a>
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    </div>

                </div>
                <!-- Mobile menu, show/hide based on menu state. -->
                <div class="sm:hidden " id="mobile-menu" x-show="open" @click.away="open = false">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                        <!-- activo:  class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium"--->

                        <!---inactivo: class="text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"--->
                        {{--   {{ request()->routeIs('noticias.*') ? 'text-white bg-blue-700' : 'text-dark hover:bg-blue-700 hover:text-white' }}
                        --}}
                        <a href="{{route('home')}}" class="text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium
                            {{ request()->routeIs('home.*') ? 'bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium' : 'text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium' }}
                            " aria-current="page">Home</a>

                        @foreach($paginas as $pagina)
                    
                        <a href="{{route('pagina.customPage',$pagina->pag_slug)}}" class="text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium
                            {{ request()->segment(2) == $pagina->pag_slug ? 'bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium' : 'text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium'}}
                                ">{{$pagina->pag_nombre}}</a>
                        @endforeach



                        <a href="{{route('noticias.index')}}" class="text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium
                            {{ request()->routeIs('noticias.*') ? 'bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium' : 'text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium'}}
                            ">Noticias</a>


                        <a href="{{route('contacto.index')}}" class="text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium
                            {{ request()->routeIs('contacto.*') ? 'bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium' : 'text-dark hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium' }}
                            ">Contacto</a>
                    </div>
                </div>
            </div>
    </div>
    </div>


    </nav>


    <main>
        <div class="max-w-7xl sm:px-6 " style="min-height: 60vh">
            <!-- Replace with your content -->
            @yield('content')
            <!-- /End replace -->
        </div>
    </main>
    <div class="w-full relative bottom-0 ">
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
                        <img src="{{$empresa->emp_logo}}" style="max-width: 300px;" alt="logo footer" srcset="">
                        <p class="opacity-60"><i class="fas fa-map-marker-alt"></i> {{$empresa->emp_direccion}}</p>
                        <p class="opacity-60"><i class="fas fa-phone"></i> {{$empresa->emp_telefono}}</p>
                    </div>
                    <div class="w-full sm:w-1/5 flex flex-col justify-center space-y-4">
                        @foreach($paginas as $pagina)
                        <a href="{{route('pagina.customPage',$pagina->pag_slug)}}" class="opacity-60">{{$pagina->pag_nombre}}</a>
                        
                        {{-- <a href="{{route('pagina.customPage',$pagina->pag_slug)}}"
                            class="px-3 py-2 rounded-md text-sm font-semibold {{ request()->segment(2) == $pagina->pag_slug ? 'text-white bg-blue-700' : 'text-dark hover:bg-blue-700 hover:text-white' }}"
                            aria-current="page">{{$pagina->pag_nombre}}</a> --}}
                        @endforeach
                      {{--   <a href="#" class="opacity-60">Quienes somos</a>
                        <a href="#" class="opacity-60">Noticias</a>
                        <a href="#" class="opacity-60">Servicios</a>
                        <a href="#" class="opacity-60">Documentos</a>
 --}}
                    </div>
                    <div class="w-full sm:w-1/5 flex flex-col justify-end space-y-4">
                        <a href="{{route('contacto.index')}}" class="opacity-60">Contacto</a>
                        <a href="#" class="opacity-60">Testimonios</a>
                        <a href="#" class="opacity-60">Politicas de privacidad</a>
                        <a href="#" class="opacity-60">Terminos de uso</a>
                    </div>
                    <div class="w-full sm:w-1/5 pt-6 flex items-end mb-1">
                        <div class="flex flex-row space-x-4">
                            <a href="{{$empresa->emp_url_facebook}}" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="{{$empresa->emp_url_twitter}}" target="_blank"> <i class="fab fa-twitter"></i></a>
                            <a href="{{$empresa->emp_url_instagram}}" target="_blank"> <i
                                    class="fab fa-instagram"></i></a>
                            {{--   <a href="{{$empresa->emp_url_google}}" target="_blank"> <i
                                class="fab fa-google"></i></a> --}}
                        </div>
                    </div>
                </div>
                <div class="opacity-60 pt-2">
                    <p>© 2021 {{$empresa->emp_razon_social}}.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Fin navbar --->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script src="https://unpkg.com/stimulus/dist/stimulus.umd.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://kit.fontawesome.com/4db6b32bd3.js" crossorigin="anonymous"></script>

    @yield('scripts')
</body>

</html>