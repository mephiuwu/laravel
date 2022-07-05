{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
</div>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <x-label for="email" :value="__('Email')" />

        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
            autofocus />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-button>
            {{ __('Email Password Reset Link') }}
        </x-button>
    </div>
</form>
</x-auth-card>
</x-guest-layout> --}}

{{-- @extends('layouts.auth')

@section('main')
<div class="container" id="container">
    <a href="{{route('home')}}" class="imagenAeurus mt-4"> <img src="{{asset('public/img/aeurus.png')}}" style="height: 100%"
            width="100%" alt=""></a>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <p class=" bg-white rounded-lg p-1 mt-3" style="margin-top: -50px; color: #64707e; font-weight: 500">Ingrese su email para poder crear su nueva contraseña.</p>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}"
                placeholder="Ingrese su email">
        </div>
        
        <button type="submit" class="btn btn-secondary">Enviar correo</button>
        <a href="{{route('login')}}" class="text-white underline text-right mt-3">Volver al login</a>

    
        @if (session('status'))
        <div class="alert alert-success mt-1" role="alert">
            {{ session('status') }}
        </div>
        @endif
    </form>
  
</div>

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

@endif

@endsection --}}




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/login.css')}}">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body class="my-login-page">
    <section class="h-100 ">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100 ">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="{{$empresa->emp_logo}}" alt="logo">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title text-center">Recuperar Contraseña</h4>
                            <form method="POST" action="{{ route('password.email') }}">
                                
                                @csrf
                                <p class=" bg-white rounded-lg p-1 mt-3" style="margin-top: -50px; color: #64707e; font-weight: 500">Ingrese su email para poder cambiar su contraseña.</p>
                                
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}"
                                        placeholder="Ingrese su email">
                                </div>
                                <div class="form-group m-0 mb-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Enviar email
                                    </button>
                                </div>
                                <a href="{{route('login')}}" class="text-dark underline text-right mt-3">Volver al login</a>
                                @if (session('status'))
                                <div class="alert alert-success mt-1" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                               
                            </form>
                          
                         
                        </div>
                    </div>
                    <div class="footer text-dark ">
                        Todos los derechos reservados &copy; 2021 &mdash; {{$empresa->emp_razon_social}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="js/my-login.js"></script>

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
        customClass: 'swal-wide',
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

</body>

</html>
