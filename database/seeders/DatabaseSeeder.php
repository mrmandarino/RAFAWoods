<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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

        User::create([

            'rut'=> '104698980',
            'nombre'=> 'Fabian',
            'apellido' => 'Avendaño',
            'correo' => 'maderas.rafa.coquimbo@gmail.com',
            'password' => bcrypt('m@rcianeke123'),
            'tipo_usuario'=> 1
        ]);

        User::create([

            'rut'=> '199670484',
            'nombre'=> 'Memito',
            'apellido' => 'Bonito',
            'correo' => 'user@user.com',
            'password' => bcrypt('cornetin123'),
            'tipo_usuario'=> 2
        ]);

        User::create([

            'rut'=> '104698980',
            'nombre'=> 'JZR',
            'apellido' => 'NRG',
            'correo' => 'nrg@gmail.com',
            'password' => bcrypt('doubleflipreset'),
            'tipo_usuario'=> 3
        ]);
    }
}
