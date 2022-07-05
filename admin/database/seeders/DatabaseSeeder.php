<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\URL;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //Poblar comunas y regiones
        $this->call(ComunasRegionesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AsuntosSeeder::class);
        $this->call(PaginasSeeder::class);

          //crear empresa 
          Empresa::create([
            'emp_razon_social' => 'Aeurus',
            'emp_email_empresarial' => 'correo@aeurus.cl',
            'emp_email_contacto' => 'aeurus@contacto.cl',
            'emp_direccion' => 'San Martín 553, Of 1302, Concepción, Chile ',
            'emp_telefono' => '+56987654321',
            'emp_logo' => URL::asset('public/aeurus.png'),
            'emp_url_facebook' => 'https://www.facebook.com/Aeurus/',
            'emp_url_twitter' => 'https://twitter.com/aeurus/',
            'emp_url_instagram' => 'https://www.instagram.com/aeurus_chile/',
            'emp_url_youtube' => 'https://www.youtube.com',
            'emp_coords_lat' => '-36.82013519999999',
            'emp_coords_lng' => '-73.0443904',
            'emp_meta_title' => 'titleSeeder',
            'emp_meta_keywords' => 'keywordsSeeder',
            'emp_meta_description' => 'descriptionSeeder',
            'emp_analytics' => "<script async src='https://www.google-analytics.com/analytics.js'></script>"
        ]);
    }
}
