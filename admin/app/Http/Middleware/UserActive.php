<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       
        //validar que el usuario que intenta loguear esta activo
        $user = User::whereEncrypted('email',$request->email)->first();
        if($user){
             
            //usuario existe
            if($user->estado == "0" ){
            
              /*   return back()->with('status_error','El usuario ingresado no se encuentra activo. Comuniquese con el administrador para mas detalles.'); */
              throw ValidationException::withMessages([
                'password' => 'El usuario ingresado no se encuentra activo. Comuníquese con el administrador para mas detalles.',
            ]);
            } 
            return $next($request);
        }
        return $next($request);
    }
}
