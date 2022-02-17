<?php

namespace Database\Seeders;

use App\Models\Orden_compra;
use Illuminate\Database\Seeder;

class Orden_compraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Orden_compra::factory(8)->create();
    }
}
