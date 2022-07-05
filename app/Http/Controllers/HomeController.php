<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('sli_estado',1)->orderBy('sli_orden')->get();
        $noticias = Noticia::latest()->take(6)->where('not_estado','=',1)->get();
        return view('pages.home', compact('noticias','sliders'));
    }

   
}
