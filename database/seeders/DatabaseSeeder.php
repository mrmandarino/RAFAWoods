<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Inventario;
use App\Models\Trabajador;
use Illuminate\Database\Seeder;

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

        Inventario::create([
            'id' => 1,
            'direccion_sucursal' => 'Orchard 965'
        ]);
        
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

        Trabajador::create([
            'usuario_rut' => '199670484',
            'tipo_trabajador' => 1,
            'sucursal_id' => 1
        ]);

        User::create([

            'rut'=> '199784242',
            'nombre'=> 'mandarino',
            'apellido' => 'wolfgang',
            'correo' => 'wolf@gmail.com',
            'password' => bcrypt('kattyperry'),
            'tipo_usuario'=> 2
        ]);

        Trabajador::create([
            'usuario_rut' => '199784242',
            'tipo_trabajador' => 2,
            'sucursal_id' => 1
        ]);

        User::create([

            'rut'=> '194445989',
            'nombre'=> 'Lelouch',
            'apellido' => 'Lamperouge',
            'correo' => 'user1@user1.com',
            'password' => bcrypt('codegeass'),
            'tipo_usuario'=> 3
        ]);


        


    }
}
