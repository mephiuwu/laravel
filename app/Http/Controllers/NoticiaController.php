<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;

class NoticiaController extends Controller
{
    public function index(){
        $noticias = Noticia::where('not_estado','=',1)->get();
       
        return view('pages.noticias',compact('noticias'));
    }

    public function show($noticia){
        $noticia = Noticia::where('not_url','=',$noticia)->first();
        return view('pages.showNoticia',compact('noticia'));
    }
}
