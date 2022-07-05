<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function customPage($slug){
        $pagina = Pagina::where('pag_slug',$slug)->first();
        
        if($pagina){
           return view('pages.customs.customPage',compact('pagina')); 
        } 

        abort(404,'Lo sentimos, pero la página que buscas no existe');

    } 
}
