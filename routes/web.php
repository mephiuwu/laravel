<?php

use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PaginaController;
use App\Models\Pagina;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;





Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('noticias')->group(function () {
    Route::get('/', [NoticiaController::class, 'index'])->name('noticias.index');
    Route::get('/show/{id}', [NoticiaController::class, 'show'])->name('noticias.show');
});

Route::prefix('contacto')->group(function () {
    Route::get('/', [ContactoController::class, 'index'])->name('contacto.index');
    Route::post('/contactar', [ContactoController::class, 'enviar_email'])->name('contacto.email');
    Route::post('/get-comunas', [ContactoController::class, 'getComunas'])->name('contacto.comunas');
});

Route::prefix('pagina')->group(function(){
  Route::get('/{slug}',[PaginaController::class,'customPage'])->name('pagina.customPage');
});

