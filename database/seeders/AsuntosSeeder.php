<?php

namespace Database\Seeders;

use App\Models\Asuntos;
use Illuminate\Database\Seeder;

class AsuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Asuntos::create([
            'asun_nombre' => 'Negocios',
            'asun_estado' => 1
        ]);
        Asuntos::create([
            'asun_nombre' => 'Comercial',
            'asun_estado' => 1
        ]);
        Asuntos::create([
            'asun_nombre' => 'Laboral',
            'asun_estado' => 1
        ]);
        Asuntos::create([
            'asun_nombre' => 'Informativo',
            'asun_estado' => 1
        ]);
    }
}
