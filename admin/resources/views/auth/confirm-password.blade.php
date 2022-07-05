{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
</div>

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <!-- Password -->
    <div>
        <x-label for="password" :value="__('Password')" />

        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="current-password" />
    </div>

    <div class="flex justify-end mt-4">
        <x-button>
            {{ __('Confirm') }}
        </x-button>
    </div>
</form>
</x-auth-card>
</x-guest-layout>
--}}

@extends('layouts.auth')

@section('main')
<div class="container" id="container">
    <a href="{{route('home')}}" class="imagenAeurus mt-4"> <img src="{{asset('public/img/aeurus.png')}}" style="height: 100%" width="100%"  alt=""></a>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="form-group">
            <label for="password"><b>Contraseña: </b> </label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese su Contraseña">
        </div>
        <button type="submit" class="btn btn-secondary">Confirmar Contraseña</button>


    </form>
</div>
@endsection