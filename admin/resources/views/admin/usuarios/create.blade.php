@extends('layouts.admin')

@section('title')
 Crear Usuario   
@endsection


@section('content')

<div class=" relative flex flex-row w-full bg-dark text-lg justify-start " style="height: 40px">
  <a href="{{route('usuarios.index')}}">
    <x-button class="bg-indigo-500 h-10 w-90 hover:bg-gray-700  text-white font-sans font-bold">
      Volver</x-button>
  </a>
</div>
<div class="relative  flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded  bg-white" style="min-height: 65vh" >
  <div class="rounded-t mb-0 px-4 py-3 border-0">
    <div class="flex flex-wrap items-center">
      <div class="relative w-full px-4 max-w-full flex-grow flex-1">
        <h3 class="font-semibold text-lg text-blueGray-700">
          Registrar Usuario
        </h3>
      </div>
    </div>
  </div>
  <div class="block w-full p-4 overflow-x-auto">
    <form action="{{route('usuarios.store')}}" method="post" id="user-form">
      @csrf
      {{--   <div class="flex w-full flex-start">
                <h2 class="text-dark text-xl font-sans font-bold py-4">Información Personal</h2>
            </div> --}}

      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <x-label for="name" class="font-sans font-semibold" value="Nombre Completo: "></x-label>
          <x-input class="block mt-1 w-full" type="text" placeholder="Ingrese su nombre" name="name"
            value="{{old('name')}}"></x-input>
          @error('name')
          <b class="text-red-500">{{$message}}</b>
          @enderror
        </div>
        <div>
          <x-label for="rut" class="font-sans font-semibold" value="Rut: "></x-label>
          <x-input class="block mt-1 w-full" type="text" placeholder="Ingrese su Rut" maxlength="12" placeholder="Rut"
            maxlength="12" id="rut" name="rut" value="{{old('rut')}}">
          </x-input>
          <div class="validate-rut">
            <b class="text-red-500 message-rut"></b>
          </div>
          @error('rut')
          <b class="text-red-500 error-rut">{{$message}}</b>
          @enderror
         
        </div>
        <div>
          <x-label for="email" class="font-sans font-semibold" value="Email: "></x-label>
          <x-input class="block mt-1 w-full" type="email" name="email" placeholder="Ingrese su Email"
            value="{{old('email')}}"></x-input>
          @error('email')
          <b class="text-red-500">{{$message}}</b>
          @enderror
        </div>
        <div>
          <x-label for="telefono" class="font-sans font-semibold" value="Teléfono: "></x-label>
          <x-input class="block mt-1 w-full" type="tel" name="telefono" placeholder="Ingrese su teléfono"
            value="{{old('telefono')}}">
          </x-input>
          @error('telefono')
          <b class="text-red-500">{{$message}}</b>
          @enderror
        </div>
        <div>
          <x-label for="password" class="font-sans font-semibold" value="Contraseña: "></x-label>
          <x-input class="block mt-1 w-full" type="password" name="password" placeholder="Ingrese su contraseña">
          </x-input>
          @error('password')
          <b class="text-red-500">{{$message}}</b>
          @enderror
        </div>

        <div>
          <x-label for="password_confirmation" class="font-sans font-semibold" value="Confirmar contraseña: ">
          </x-label>
          <x-input class="block mt-1 w-full" type="password" name="password_confirmation"
            placeholder="Repita su contraseña">
          </x-input>
          @error('password_confirmation')
          <b class="text-red-500">{{$message}}</b>
          @enderror
        </div>
        <div>
          <div class="mt-2">
            <x-label for="rol" class="font-sans font-semibold" value="Rol de usuario: "></x-label>
            <div class="mt-2">
              <label class="inline-flex items-center">
                <input type="radio" class="form-radio" name="rol" value="1" {{ old('rol') == 1 ? 'checked' : '' }}>
                <span class="ml-2">Administrador</span>
              </label>
              <label class="inline-flex items-center ml-6">
                <input type="radio" class="form-radio" name="rol" value="2" {{ old('rol') == 2 ? 'checked' : '' }}>
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
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
          <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
          </div>
        </div>
        @error('estado')
        <b class="text-red-500">{{$message}}</b>
        @enderror
      </div>

      <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
          <div class="border-t border-gray-200"></div>
        </div>
      </div>
      <div class="flex items-center justify-end ">
        <x-button id="btn-register"
          class="ml-3 mt-2 bg-indigo-500 h-10 w-90 hover:bg-gray-700  text-white font-sans font-bold ">
          Registrar usuario
        </x-button>
      </div>
    </form>
  </div>

</div>

<footer class="block py-4 ">
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
<script src="{{asset('public/assets/js/jqueryRut.js')}}"></script>
<script src="{{asset('public/assets/js/validarRut.js')}}"></script>


@if($errors->any())
<script>
  /*  var message = @json($errors->first()); */
        console.log(@json($errors));
      /*   console.log(message); */

      /*   const Toast = Swal.mixin({
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
        }) */
</script>
@endif


{{-- 
<script>
    document.getElementById('rut').addEventListener('input', function(evt) {
  let value = this.value.replace(/\./g, '').replace('-', '');
  
  if (value.match(/^(\d{2})(\d{3}){2}(\w{1})$/)) {
    value = value.replace(/^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4');
  }
  else if (value.match(/^(\d)(\d{3}){2}(\w{0,1})$/)) {
    value = value.replace(/^(\d)(\d{3})(\d{3})(\w{0,1})$/, '$1.$2.$3-$4');
  }
  else if (value.match(/^(\d)(\d{3})(\d{0,2})$/)) {
    value = value.replace(/^(\d)(\d{3})(\d{0,2})$/, '$1.$2.$3');
  }
  else if (value.match(/^(\d)(\d{0,2})$/)) {
    value = value.replace(/^(\d)(\d{0,2})$/, '$1.$2');
  }
  this.value = value;
});

</script> --}}

<script>
  $(function() {
    $("input#rut").rut({
        formatOn: 'keyup',
        minimumLength: 8, // validar largo mínimo; default: 2
        validateOn: 'change' // si no se quiere validar, pasar null
    }).on('rutInvalido',function(e){
        $('.validate-rut .message-rut').html('');
        $('.error-rut').html('');
        $('.validate-rut .message-rut').html('El rut ingresado es invalido');
    }).on('rutValido',function(e){
      $('.error-rut').html('');
        $('.validate-rut .message-rut').html('');
    });

  });

  $('#btn-register').click(function (e) { 
   e.preventDefault();

   let rut =  $("input#rut").val();
   if($.validateRut(rut)) {
     $('#user-form').submit();
    }else{
      $('.validate-rut .message-rut').html('');
      $('.error-rut').html('');
      $('.validate-rut .message-rut').html('El rut ingresado es invalido');
   }
   
 });

   
</script>
@endsection