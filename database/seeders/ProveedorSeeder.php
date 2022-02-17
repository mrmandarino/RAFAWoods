<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedor::create([
            'rut' => '768213305',
            'razon_social' => 'Imperial S.a.',
            'correo' => 'imperial@imperial.cl',
            'ubicacion' => 'Santa Rosa 7850, La Granja - Santiago'
        ]);

        Proveedor::create([
            'rut' => '775592303',
            'razon_social' => 'Proveedores De Madera Manufacturada Limitada',
            'correo' => 'prodema@prodema.cl',
            'ubicacion' => 'Padre Lorenzo Eiting #5911 #5893, Quinta Normal · Santiago, Chile'
        ]);

        Proveedor::create([
            'rut' => '965396802',
            'razon_social' => 'Maderas Chile S.a.',
            'correo' => 'maderaschile@maderaschile.cl',
            'ubicacion' => 'Arturo Fernández 837 Iquique'
        ]);


    }
}
