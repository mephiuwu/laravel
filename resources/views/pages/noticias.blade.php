@extends('layouts.app')

@section('title')
    Noticias
@endsection

@section('content')

    <div class="container my-12 mx-auto px-4 md:px-12">
        <h2 class="text-center text-5xl font-bold ">
            Todas las noticias
        </h2>

        <div class="flex flex-wrap -mx-1 lg:-mx-4">

            @forelse ($noticias as $noticia)
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3 "   >

                    <!-- Article -->
                    <article class="overflow-hidden rounded-lg shadow-lg " style="height: 500px">

                        <a href="{{route('noticias.show',$noticia)}}">
                            <img alt="Placeholder" class="block h-auto w-full" style="height: 250px; object-fit:cover" src="{{$noticia->imagenes[0]->gnot_path ?? asset('public/img/no-image.png')}}">
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
                
            @empty 
             <div class="flex w-full justify-center flex-col items-center p-4">
                <h2 class="text-4xl">No se han publicado noticias</h2>
                 <img src="{{asset('public/img/imagen_no_results.svg')}}" style="height: 50vh; width: 400px;" alt="Sin resultados" >
             </div>
            @endforelse
        </div>
    </div>

@endsection

@section('scripts')
    <script>
    </script>

@endsection
