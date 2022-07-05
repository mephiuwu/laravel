<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //crear rol admin
        $rol_admin = Roles::create([
              'rol_name' => 'Admin'
        ]);
         //crear rol user
        $rol_user = Roles::create([
            'rol_name' => 'User'
        ]); 
       
        //crear usuario admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'super@aeurus.cl',
            'rut' => '11.111.111-1',
            'password' => Hash::make('password'),
            'estado' => '1',
            'telefono' => '+56911111111',
            'rol_id' => $rol_admin->id
        ]);

        //crear usuario comun
        $user = User::create([
           'name' => 'User',
           'email' => 'user@aeurus.cl',
           'rut' => '22.222.222-2',
           'password' => Hash::make('password'),
            'estado' => '1',
            'telefono' => '+56922222222',
            'rol_id' => $rol_user->id
        ]);
    }
}
