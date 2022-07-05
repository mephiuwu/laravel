<?php

namespace Database\Seeders;

use App\Models\Galeria_paginas;
use App\Models\Pagina;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PaginasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //pagina quienes somos 
        $q_somos = Pagina::create([
            'pag_nombre' => 'Quiénes somos',
            'pag_contenido' => 'Esta es la pagina quienes somos test',
            'pag_estado' => 1,
            'pag_orden' => 1,
            'pag_slug' => Str::slug('quienes somos')
        ]);
        
        //agregar imagenes a la pagina quienes somos

        $portada = Galeria_paginas::create([
          'gpag_nombre' => 'Portada de prueba',
          'gpag_path' => URL::asset('public/default_gallery.jpg'),
          'gpag_pagina_id' => $q_somos->id
        ]);
         
    }
}
