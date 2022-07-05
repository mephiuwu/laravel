@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')

    <style>
        .swiper-container {
            width: 100%;
            height: 100%;
        }

    </style>



    <div class="w-100">
        <!-- Slider main container -->
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->

                @forelse($sliders as $slider)
                <div class="swiper-slide">
                    <img src="{{$slider->sli_path}}" alt="{{$slider->sli_nombre}}" 
                        style="width: 100%; max-height: 600px; object-fit:cover; background-size:cover">
                </div>
                @empty 
                <div class="swiper-slide">
                    <img src="{{asset('public/img/slider-default.png')}}" alt="Aeurus Slider" 
                        style="width: 100%; max-height: 600px; object-fit:cover; background-size:cover">
                </div>
                @endforelse

{{-- 
                <div class="swiper-slide">

                    <img class="position-absolute" src="http://sitiobase.aeurus.cl/imagenes/borrar/img-slider02.jpg"
                        alt="img 1" style="width: 100%" srcset="">
                </div>
                <div class="swiper-slide">
                  

                    <img src="http://sitiobase.aeurus.cl/imagenes/borrar/img-slider02.jpg" style="width: 100%" alt="img 1"
                        srcset="">
                </div> --}}

            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- If we need scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>

    </div>

    <div class="container my-12 mx-auto px-4 md:px-12">
        @if($noticias->count() > 0)
        <h2 class="text-center text-5xl font-bold ">
            Últimas Noticias
        </h2>
        @endif

        <div class="flex flex-wrap -mx-1 lg:-mx-4">

            @foreach ($noticias as $noticia)
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3"   >

                    <!-- Article -->
                    <article class="overflow-hidden rounded-lg shadow-lg" >

                        <a href="{{route('noticias.show',$noticia)}}">
                            <img alt="Noticia" style="height: 300px; object-fit:cover" class="block w-full" src="{{$noticia->imagenes[0]->gnot_path ?? asset('public/img/no-image.png') }}">
                        </a>
                        <div class="flex flex-col justify-evenly " style="height: 250px">
                            <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                                <h1 class="text-lg">
                                    <a class="no-underline hover:underline font-bold text-black" href="{{route('noticias.show',$noticia)}}">
                                        @php 
                                        $titulo = Str::limit($noticia->not_titulo, 200,'...');
                                        @endphp  
                                        {{ $titulo }}    
                                    </a>
                                </h1>
                            </header>
    
                            <p class="px-4 py-1" style=" ">
                                @php 
                                $resumen = Str::limit($noticia->not_resumen, 120, ' (...)');
                                @endphp  
                                {{ $resumen }}
                            </p>
                            <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                                <a class="flex items-center no-underline hover:underline text-black" href="#">
    
                                    <p class="text-grey-darker text-sm">
                                        {{ $noticia->created_at->format('d-m-Y') }}
                                    </p>
                                </a>
                                <a class="text-grey-darker hover:text-red-dark hover:underline" href="{{route('noticias.show', $noticia)}}">
                                    Leer mas
                                </a>
                            </footer>
                        </div>

                    </article>
                    <!-- END Article -->

                </div>
            @endforeach


        </div>

        <h2 class="text-center text-5xl font-bold mt-10">
            Nuestros clientes
        </h2>


    </div>
    <div class="flex w-full -mx-1 lg:-mx-4 p-5 my-10 slider-clientes">

        <div class="splide w-full">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide flex justify-center ">
                        <img src="{{ asset('public/assets/img/clientes/adidas.jpg') }}" class="text-center" alt="" srcset="">
                    </li>
                    <li class="splide__slide flex justify-center ">
                        <img src="{{ asset('public/assets/img/clientes/artel.jpg') }}" class="text-center" alt="" srcset="">
                    </li>
                    <li class="splide__slide flex justify-center ">
                        <img src="{{ asset('public/assets/img/clientes/cencosud.jpg') }}" class="text-center" alt="" srcset="">
                    </li>
                    <li class="splide__slide flex justify-center ">
                        <img src="{{ asset('public/assets/img/clientes/coca-cola.png') }}" class="text-center" alt="" srcset="">
                    </li>
                    <li class="splide__slide flex justify-center ">
                        <img src="{{ asset('public/assets/img/clientes/codelco.png') }}" class="text-center" alt="" srcset="">
                    </li>
                    <li class="splide__slide flex justify-center ">
                        <img src="{{ asset('public/assets/img/clientes/colun.jpg') }}" class="text-center" alt="" srcset="">
                    </li>
                    <li class="splide__slide flex justify-center ">
                        <img src="{{ asset('public/assets/img/clientes/gobierno-de-chile.jpg') }}" class="text-center" alt=""
                            srcset="">
                    </li>
                    <li class="splide__slide flex justify-center ">
                        <img src="{{ asset('public/assets/img/clientes/lan-cargo.jpg') }}" class="text-center" alt="" srcset="">
                    </li>
                </ul>
            </div>
        </div>

    </div>



@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <script>
        var mySwiper = new Swiper('.swiper-container', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
        var swiperClientes = new Swiper('#swiper-clientes', {
            slidesPerView: 3,
            spaceBetween: 100,
            slidesPerGroup: 3,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });


        document.addEventListener('DOMContentLoaded', function() {
            new Splide('.splide', {
                type: 'loop',
                perPage: 4,

            }).mount();
        });

    </script>

@endsection
