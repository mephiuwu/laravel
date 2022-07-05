@extends('layouts.admin')

@section('title')
 Editar asuntos   
@endsection

@section('content')
{{-- <div class="container w-full mx-auto md:px-12 bg-gray-200 rounded-lg shadow-lg">
    <div class="space-y-6 py-5">
        <div class="text-center text-dark text-4xl font-bold">
            <h2>Crear Asunto</h2>
        </div>
        .form-group
    </div>
   
    
 </div> --}}
 <div class="px-4 md:px-10 mx-auto w-full -m-24">
    <div class="flex flex-wrap justify-center mt-4">
        
        <div class="w-10/12 mb-12 px-4">
            <div class="flex flex-row w-full bg-dark text-lg justify-start " style="height: 40px">
                <a href="{{route('asuntos.index')}}" class="w-100 bg-red-700 absolute hover:bg-gray-200 text-white font-bold py-2 px-4 rounded">
                   Volver
                </a>
             </div>
             
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded bg-white" style="min-height: 60vh">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-center text-4xl  text-blueGray-700">
                                Editar Asunto
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <form action="{{route('asuntos.update',$asunto->id)}}" method="POST" class="w-full max-w-lg">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-wrap justify-center -mx-3 mb-6">
                          <div class=" md:w-1/2 w-6/12 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                               Nombre: 
                            </label>
                            <input style="width: 100%; margin:auto;" value="{{$asunto->asun_nombre}}" name="nombre"
                             class="appearance-none block w-full bg-gray-200 my-10 text-gray-700 border border-red-500 rounded py-3 px-8 mb-3 leading-tight focus:outline-none focus:bg-white" 
                             id="nombre" type="text" placeholder="Ingrese el asunto">
                          </div>
                          <div class="w-full flex justify-center md:w-1/2 px-3 mb-6 md:mb-0">
                            <button type="submit" class="w-100 bg-teal-500 absolute hover:bg-gray-200 text-white font-bold py-2 px-6 rounded">
                                Actualizar
                             </button>
                          </div>
                          </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')


@if($errors->any())

<script>
    var message = @json($errors->first());
    console.log(message);

    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
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
    
@endsection