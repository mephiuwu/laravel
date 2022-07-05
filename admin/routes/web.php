<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsuntosController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\SliderController;
use App\Models\Contactos;

/* Route::get('/', function () {
    return view('pages.home');
})->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); */


Route::middleware(['auth'])->group(function () {
    Route::view('/', 'admin.inicio.index')->name('home');

    Route::prefix('perfil')->group(function () {
        Route::get('/',[UsuarioController::class,'profile'])->name('perfil.index');
        Route::put('/update',[UsuarioController::class,'update_profile'])->name('profile.update');
        Route::put('/update_image',[UsuarioController::class,'update_image'])->name('profile.updateImg');
        Route::put('/update-password',[UsuarioController::class,'update_password'])->name('update.password');
    });

    Route::prefix('asuntos')->group(function(){
        Route::get('/', [AsuntosController::class,'index'])->name('asuntos.index');
        Route::post('/create',[AsuntosController::class,'create'])->name('asuntos.create');
        Route::post('/eliminar',[AsuntosController::class,'eliminar'])->name('asuntos.eliminar');
        Route::get('/datos-editar',[AsuntosController::class,'datosEditar'])->name('asuntos.datosEditar');
        Route::post('/editar',[AsuntosController::class,'editar'])->name('asuntos.editar');
        Route::post('/table-asuntos',[AsuntosController::class,'table'])->name('asuntos.table');
    });

    Route::prefix('usuarios')->middleware('authAdmin')->group(function(){
        Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::post('/table-usuarios',[UsuarioController::class,'table'])->name('usuarios.table');
        Route::post('/data-modal-delete', [UsuarioController::class,'dataDelete'])->name('usuarios.dataDelete');
        Route::post('/delete',[UsuarioController::class,'delete'])->name('usuarios.delete');
        Route::get('/create',[UsuarioController::class,'create'])->name('usuarios.create');
        Route::post('/store',[UsuarioController::class,'store'])->name('usuarios.store');
        Route::get('/edit/{id}',[UsuarioController::class,'edit'])->name('usuarios.edit');
        Route::put('/update/{id}',[UsuarioController::class,'update'])->name('usuarios.update');
    });
  
    Route::prefix('empresa')->middleware('authAdmin')->group(function () {
        Route::get('/',[EmpresaController::class,'index'])->name('empresa.index');
        Route::put('/update/{id}',[EmpresaController::class,'update'])->name('empresa.update');
        Route::post('/crop_image', [EmpresaController::class,'imageCropPost'])->name('empresa.cropImage');
    });
    
    Route::prefix('noticia')->group(function (){
        Route::get('/', [NoticiaController::class,'index'])->name('noticia.index');
        Route::post('/table-noticias',[NoticiaController::class,'table'])->name('noticia.table');
        Route::get('/create',[NoticiaController::class,'create'])->name('noticia.create');
        Route::post('/store',[NoticiaController::class,'store'])->name('noticia.store');
        Route::post('/upload',[NoticiaController::class,'upload'])->name('noticia.upload');
        Route::post('/dataDelete',[NoticiaController::class,'dataDelete'])->name('noticia.dataDelete');
        Route::post('/delete', [NoticiaController::class,'delete'])->name('noticia.delete');
        Route::get('/edit-view/{id}', [NoticiaController::class,'editView'])->name('noticia.editView');
        Route::put('/update/{id}', [NoticiaController::class,'update'])->name('noticia.update');
        Route::get('/galeria/{id}',[NoticiaController::class,'galery'])->name('noticia.galery');
        Route::post('/fileStore',[NoticiaController::class,'fileStore'])->name('noticia.fileStore');
        Route::post('/eliminarFoto',[NoticiaController::class,'eliminarFoto'])->name('noticia.eliminarFoto');
    });
    
    Route::prefix('contactos')->group(function(){
        Route::get('/', [ContactoController::class,'index'])->name('contactos.index');
        Route::post('/table-contactos' , [ContactoController::class,'table'])->name('contactos.table');
    /*     Route::post('/contactos/export',[ContactoController::class,'export'])->name('contactos.export'); */
        Route::get('/contactos/export',[ContactoController::class,'exportExcel'])->name('contactos.export');
        Route::get('/grafico', [ContactoController::class,'grafico'])->name('contactos.grafico')->middleware('authAdmin');
        Route::get('/datosGrafico', [ContactoController::class,'datosGrafico'])->name('contactos.datosGrafico')->middleware('authAdmin');
        Route::get('/detalle/{id}',[ContactoController::class,'detalle'])->name('contactos.detalle');
        Route::post('/filtroGrafico', [ContactoController::class,'filtroGrafico'])->name('contactos.filtroGrafico')->middleware('authAdmin');

        Route::get('/PDF', [ContactoController::class,'PDF'])->name('contactos.PDF');
       /*  Route::post('/filtroGrafico', [ContactoController::class,'filtroGrafico'])->name('contactos.filtroGrafico'); */
    });

    Route::prefix('sliders')->group(function(){
       Route::get('/',[SliderController::class,'index'])->name('sliders.index'); 
       Route::post('/table-sliders' , [SliderController::class,'table'])->name('sliders.table');
       Route::get('/create',[SliderController::class,'create'])->name('sliders.create');
       Route::post('/store',[SliderController::class,'store'])->name('slider.store');
       Route::get('/edit/{id}',[SliderController::class,'edit'])->name('slider.edit');
       Route::put('/update/{id}',[SliderController::class,'update'])->name('slider.update');
       Route::post('/delete',[SliderController::class,'delete'])->name('slider.delete');
       Route::post('/crop_image',[SliderController::class,'crop_image'])->name('slider.cropImage');
    });

    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class,'index'])->name('logs.index')->middleware('superUser');

    Route::prefix('paginas')->group(function(){
         Route::get('/',[PaginaController::class,'index'])->name('paginas.index');
         ROute::post('/table-paginas',[PaginaController::class,'table'])->name('paginas.table');
         Route::get('/create',[PaginaController::class,'create'])->name('paginas.create');
         Route::post('/upload',[PaginaController::class,'upload'])->name('paginas.upload');
         Route::post('/store',[PaginaController::class,'store'])->name('paginas.store');
         Route::get('/edit/{id}',[PaginaController::class,'edit'])->name('paginas.edit');
         Route::put('/update/{id}',[PaginaController::class,'update'])->name('paginas.update');
         Route::post('/delete',[PaginaController::class,'delete'])->name('paginas.delete');
    });
    
 /*    Route::view('log-test', 'admin.logs.index')->name('logs.index'); */


});



require __DIR__.'/auth.php';
