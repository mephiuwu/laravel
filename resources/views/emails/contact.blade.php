@component('mail::message')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{$empresa['emp_logo']}}" class="logo" alt="Aeurus Logo">
@endcomponent
@endslot
# Hola Admin
<br>
<p>Has recibido un nuevo mensaje desde el formulario de contacto en <b>{{config('app.name')}}</b>
</p>
<p>
Mensaje: 
<br>
{{$contacto['con_mensaje']}}
</p>
@endcomponent