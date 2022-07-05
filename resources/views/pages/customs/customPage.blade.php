@extends('layouts.app')

@section('title')
    {{$pagina->pag_nombre}}
@endsection

@section('content')

<div class="container my-12 mx-auto px-4 md:px-12">
    <h2 class="text-center text-5xl font-bold ">
        {{$pagina->pag_nombre}}
    </h2>

    <div class="flex flex-wrap -mx-1 lg:-mx-4 py-2 ">
       {{--  <div class="px-4 w-full">
            <p class="text text-justify">
                {!! $pagina->pag_contenido !!}
            </p>
        </div> --}}
        <div class="flex flex-col">
            <div class="px-4  ">
                <p class=" text-justify  ">
                 {!! $pagina->pag_contenido !!}
                </p>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script>
</script>

@endsection