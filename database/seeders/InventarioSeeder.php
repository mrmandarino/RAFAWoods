<?php

namespace Database\Seeders;

use App\Models\Inventario;
use Illuminate\Database\Seeder;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventario::create([
            'id' => 1,
            'direccion_sucursal' => 'Orchard 965'
        ]);

        Inventario::create([
            'id' => 2,
            'direccion_sucursal' => '14 de Febrero 3154'
        ]);

        Inventario::create([
            'id' => 3,
            'direccion_sucursal' => 'Marathon 5300'
        ]);

        Inventario::create([
            'id' => 4,
            'direccion_sucursal' => 'Av. Angamos 0610'
        ]);
    }
}
