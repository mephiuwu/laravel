@extends('layouts.admin')

@section('title')
 Perfil   
@endsection

@section('content')
<div class="px-4 md:px-10 mx-auto w-full -m-24 ">
  <div class="flex flex-wrap">
    <div class="w-full lg:w-8/12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
        <form action="{{route('profile.update')}}" method="POST">
          @csrf
          @method('PUT')
          <div class="rounded-t bg-white mb-0 px-6 py-6">
            <div class="text-center flex justify-between">
              <h6 class="text-blueGray-700 text-xl font-bold">
                Mi Cuenta
              </h6>

            </div>
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">

            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
              Información de Usuario
            </h6>
            <div class="flex flex-wrap">
              <div class="w-full lg:w-6/12 px-4">
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password">
                    Nombre
                  </label>
                  <input type="text" name="name" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 
                    bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear
                     transition-all duration-150" value="{{Auth::user()->name}}" />
                  @error('name')
                  <b class="text-red-500">{{$message}}</b>
                  @enderror
                </div>
              </div>
              <div class="w-full lg:w-6/12 px-4">
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password">
                    Email
                  </label>
                  <input type="email" name="email"
                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    value="{{Auth::user()->email}}" />
                  @error('email')
                  <b class="text-red-500">{{$message}}</b>
                  @enderror
                </div>
              </div>

            </div>

            <hr class="mt-6 border-b-1 border-blueGray-300" />

            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
              Información de Contacto
            </h6>
            <div class="flex flex-wrap">
              <div class="w-full lg:w-12/12 px-4">
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password">
                    Teléfono
                  </label>
                  <input type="text"
                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    value="{{Auth::user()->telefono}}" name="phone" />
                  @error('phone')
                  <b class="text-red-500">{{$message}}</b>
                  @enderror
                </div>
              </div>

            </div>

            <div class="flex w-full justify-end">
              <button
                class="bg-pink-500 mt-4  text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                type="submit">
                Actualizar Perfil
              </button>
            </div>
        </form>
        <hr class="mt-4 mb-3 border-b-1 border-blueGray-300" />
        <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
          Actualizar Contraseña
        </h6>
        <form action="{{route('update.password')}}" method="post">
          @csrf
          @method('PUT')
          <div class="flex flex-wrap">
            <div class="w-full  px-4">
              <div class="relative w-full mb-3">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password">
                  Contraseña Actual
                </label>
                <input autocomplete="off" type="password" name="old_password" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 
                      bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear
                       transition-all duration-150" />
                @error('old_password')
                <b class="text-red-500">{{$message}}</b>
                @enderror
              </div>
            </div>
            <div class="w-full  px-4">
              <div class="relative w-full mb-3">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password">
                  Nueva Contraseña
                </label>
                <input type="password" autocomplete="off" name="password" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 
                      bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear
                       transition-all duration-150" />
                @error('password')
                <b class="text-red-500">{{$message}}</b>
                @enderror
              </div>
            </div>
            <div class="w-full  px-4">
              <div class="relative w-full mb-3">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password">
                  Confirme la nueva contraseña
                </label>
                <input type="password" autocomplete="off" name="password_confirmation" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 
                      bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear
                       transition-all duration-150" />
                @error('password_confirmation')
                <b class="text-red-500">{{$message}}</b>
                @enderror
              </div>
            </div>
            <div class="flex w-full justify-end">
              <button
                class="bg-pink-500 mt-4  text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150">
                Actualizar Contraseña
              </button>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>
  <div class="w-full lg:w-4/12 px-4">
    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16">
      <div class="px-6">
        <div class="flex flex-wrap justify-center">
          <div class="w-full px-4 m-auto  flex justify-center mb-10">
            <div class="relative flex flex-col justify-center" id="container_image">
              <div style="height: 150px; width:150px;"
                class="h-auto shadow-xl absolute align-middle -m-16 -ml-20 lg:-ml-16 rounded-full flex items-center justify-center text-white  bg-white">
                @if(Auth::user()->profile_image )

                <img alt="{{ Auth::user()->name }}" style="height: 100%; width: 100%; object-fit:cover"
                  id="profile_image" name="profile_image" src="{{Auth::user()->profile_image}}" class="shadow-xl rounded-full h-full w-full align-middle 
                  border-none absolute -m-16 -ml-30 lg:-ml-16 " />
                @else
                <span id="profile_default" style="height: 150px; width:150px; font-size: 60px;" class="empty-avatar text-5xl text-center h-auto shadow-xl absolute align-middle -m-16 -ml-31 lg:-ml-16
                 max-w-150-px rounded-full flex items-center justify-center text-white bg-green-200   ">
                  {{strtoupper(Auth::user()->name[0])}}
                </span>
                @endif
              </div>

            </div>
            <form action="{{route('profile.updateImg')}}" enctype="multipart/form-data" id="avatarform">
              @csrf
              @method('PUT')
              <input type="file" hidden name="avatarinput" id="avatarInput">
            </form>
          </div>

        </div>
        <div class="text-center flex justify-center ml-4 flex-col mt-12 mb-10">
          <x-button id="btn-image" class="bg-blue-500 mx-auto mb-4">Cambiar Foto</x-button>
          <h3 class="text-xl font-semibold leading-normal text-blueGray-700 mb-2">
            {{Auth::user()->name}}
          </h3>

          <div class="mb-2 text-blueGray-600 ">
            <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i>
            @if(Auth::user()->rol_id == 1)
            Administrador
            @elseif(Auth::user()->rol_id == 2)
            Usuario
            @endif
          </div>

        </div>

      </div>
    </div>

  </div>

</div>



@endsection


@section('scripts')
@if(session('profile_updated'))

<script>
  var message = @json(session('profile_updated'));
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
@php Session::forget('profile_updated') @endphp

@endif

@if(session('password_updated'))

<script>
  var message = @json(session('password_updated'));
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
        });
</script>
@php Session::forget('password_updated') @endphp

@endif

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
@php Session::forget('errors') @endphp

@endif




<script>
  $(document).ready(function() {
        
        function generarAlerta(type,message){
     
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
              icon: type,
              title: message
          });
        }


        $avatarInput = $('#avatarInput');
        $avatarform = $('#avatarform');
        $photo = $('#profile_image');
        $btn = $('#btn-image');
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $btn.on('click',function(){
             $avatarInput.click();
        });
        const url = $avatarform.attr('action');
        const form  = $('#avatarform');
        $avatarInput.on('change',function(){
             //ajax
             let formData = new FormData($('#avatarform')[0]);
             console.log($('#avatarform')[0]);
            
             $.ajax({
                type:'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $photo.attr('src','{{ URL::asset("public/loading.gif") }}');
                },
                success: (response) => {
                if(response.status == 200){
                  let photo = document.getElementsByName('profile_image');
                  if(photo.length > 0){
                    photo.forEach(photo => {
                        photo.setAttribute('src',response.photo);
                    });
                  }else{
                      $('#container_image').html('');
                      let name = @json(Auth::user()->name);
                      let image = response.photo;
                      let letra = @json(strtoupper(Auth::user()->name[0]));
                       
                      $('#container_image').html(`
                      <div style="height: 150px; width:150px;"
                        class="h-auto shadow-xl absolute align-middle -m-16 -ml-20 lg:-ml-16 rounded-full flex items-center justify-center text-white  bg-white">
                      <img alt="${name}" style="height: 100%; width: 100%; object-fit:cover"
                        id="profile_image" name="profile_image" src="${image}" class="shadow-xl rounded-full h-full w-full align-middle 
                        border-none absolute -m-16 -ml-30 lg:-ml-16 " /></div>
                      `);
                      $('.profile_navbar').each(function(){
                        $(this).html(  ` 
                        <img class="w-full  rounded-full align-middle border-none shadow-lg"
                          style="height: 100%; width:100%; object-fit:cover"
                          src="${image}" name="profile_image" width="46"
                          height="46" id="profile_image" alt="${name}" />
                        `)
                      });
                    }
                    generarAlerta('success',response.message);
                 }else{
                    generarAlerta('error',response.message);
                 } 
                 
                   },
                  
                  error: function(response){
                    generarAlerta('error',response.message);
                  },
              });
    });
  });
</script>



@endsection