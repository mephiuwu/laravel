@extends('layouts.app')



@section('content')
@section('title')
{{$noticia->not_titulo}}
@endsection
<style>
    .date-notice {
        color: #444;
        font-family: serif;
        font-size: 18px;
        line-height: 14px;
        margin-bottom: 10px;
    }
</style>

<div class="container py-12 mx-auto px-4 md:px-12 bg-gray-100">
    <div class="text-left -mx-1 lg:-mx-4 date-notice ">
        {{-- {{ $noticia->created_at->format('d-m-Y H:i') }} --}}
        {{--   $diaActual = Carbon::now()->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y'); --}}
        @php
        $fecha = \Carbon\Carbon::parse($noticia->created_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y');
        @endphp
        {{ ucfirst(trans($fecha))}} | {{$noticia->created_at->format('H:i')}}
    </div>
    <h2 class="text-left text-3xl font-bold ">
        {{ $noticia->not_titulo }}
    </h2>
    <br>

    <br>
    <div class="grid  gap-4 @if($noticia->imagenes->first()) grid-cols-2 @else grid-cols-1 @endif">
        <div>
            <div class="-mx-1 lg:-mx-4">
                @php echo htmlspecialchars_decode($noticia->not_contenido)@endphp
            </div>
        </div>
        <!-- ... -->
        @if($noticia->imagenes->first())
        <div>
            <div class="block w-full p-4 overflow-x-auto flex flex-center flex-col">
                <div class="imagenesGaleria flex flex-wrap">
                    <div class="grid grid-cols-1 gap-1 mt-1 mb-1 mr-1 ml-1">
                        <div class="container ">
                            <img class="imgGallery"
                                src="{{$noticia->imagenes[0]->gnot_path ?? asset('public/img/no-image.png')}}"
                                alt="{{asset('public/img/no-image.png')}}" style="width: 100%; height:100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <br>
    <br>
    <div class="block w-full p-4 overflow-x-auto flex flex-center flex-col">
        <div class="imagenesGaleria flex flex-wrap">
            @foreach ($noticia->imagenes as $aux=>$item)
            @if ($aux != 0)
            <div class="grid grid-cols-1 gap-1 mt-1 mb-1 mr-1 ml-1">
                <div class="container" style="width: 222px; height: 222px">
                    <img class="imgGallery" src="{{ $item->gnot_path }}" alt="" style="width: 100%; height:100%">
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>



@endsection

@section('scripts')

<script>
</script>

@endsection