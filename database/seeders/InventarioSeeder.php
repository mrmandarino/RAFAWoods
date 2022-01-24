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
    }
}
