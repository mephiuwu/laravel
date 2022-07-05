@extends('layouts.admin')

@section('title')
 Editar Usuario   
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
<div class=" relative flex flex-row w-full bg-dark text-lg justify-start " style="height: 40px">
    <a href="{{route('usuarios.index')}}">
        <x-button class="bg-indigo-500 h-10 w-90 hover:bg-gray-700  text-white font-sans font-bold">
            Volver</x-button>
    </a>
</div>
<div class="relative  flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded  bg-white" >
    <div class="rounded-t mb-0 px-4 py-3 border-0">
        <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-lg text-blueGray-700">
                    Actualizar Usuario
                </h3>
            </div>
        </div>
    </div>
    <div class="block w-full p-4 overflow-x-auto">
       
        <form action="{{route('usuarios.update',$user->id)}}" method="post">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <x-label for="name" class="font-sans font-semibold" value="Nombre Completo: "></x-label>
                    <x-input class="block mt-1 w-full " placeholder="Ingrese su nombre" type="text" name="name"
                        value="{{ $user->name}}"></x-input>
                    @error('name')
                    <b class="text-red-500">{{$message}}</b>
                    @enderror
                </div>
                <div>
                    <x-label for="rut" class="font-sans font-semibold" value="Rut: "></x-label>
                    <x-input class="block mt-1 w-full" type="text" id="rut"  name="rut" maxlength="12"
                        placeholder="Ingrese su Rut" value="{{$user->rut}}" ></x-input>
                    @error('rut')
                    <b class="text-red-500">{{$message}}</b>
                    @enderror
                </div>
                <div>
                    <x-label for="email" class="font-sans font-semibold" value="Email: "></x-label>
                    <x-input class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}"
                        placeholder="Ingrese su Email"></x-input>
                    @error('email')
                    <b class="text-red-500">{{$message}}</b>
                    @enderror
                </div>
                <div>
                    <x-label for="telefono" class="font-sans font-semibold" value="Teléfono: "></x-label>
                    <x-input class="block mt-1 w-full" type="tel" name="telefono" value="{{$user->telefono}}"
                        placeholder="Ingrese su teléfono">
                    </x-input>
                    @error('telefono')
                    <b class="text-red-500">{{$message}}</b>
                    @enderror
                </div>
                
                <div>
                    <div class="mt-2">
                        <x-label for="rol" class="font-sans font-semibold" value="Rol de usuario: "></x-label>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="rol" value="1"
                                    {{ $user->rol_id== "1" ? 'checked' : '' }}>
                                <span class="ml-2">Administrador</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" class="form-radio" name="rol" value="2"
                                    {{ $user->rol_id == "2" ? 'checked' : '' }}>
                                <span class="ml-2">Usuario</span>
                            </label>
                        </div>
                    </div>
                    @error('rol')
                    <b class="text-red-500">{{$message}}</b>
                    @enderror
                </div>
                <div class="relative inline-block w-full text-gray-700">
                    <x-label for="estado" class="font-sans font-semibold" value="Estado: "></x-label>
                    <select name="estado"
                        class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"
                        placeholder="Seleccione un estado">
                        <option value="2" selected>Seleccione una opcion</option>
                        <option value="1" @if($user->estado == "1") selected @endif>Activo</option>
                        <option value="0" @if($user->estado == "0") selected @endif >Inactivo</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    </div>
                    @error('estado')
                    <b class="text-red-500">{{$message}}</b>
                    @enderror
                </div>

            </div>

            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>
            <div class="flex items-center justify-end ">
                <x-button class="ml-3 mt-2 bg-indigo-500 h-10 w-90 hover:bg-gray-700  text-white font-sans font-bold ">
                    Actualizar usuario
                </x-button>
            </div>
        </form>
    </div>

</div>



@endsection


@section('scripts')
<script src="{{asset('public/assets/js/jqueryRut.js')}}"></script>

<script>
    $(function() {
        $("input#rut").rut({
        formatOn: 'keyup',
        minimumLength: 8, // validar largo mínimo; default: 2
        validateOn: 'change' // si no se quiere validar, pasar null
    });
    })
</script>

@if(session('user_updated'))
<script>
    var message = @json(session('user_updated'));
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
            icon: 'success',
            title: message
        })
</script>
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
@endif



@endif



@endsection