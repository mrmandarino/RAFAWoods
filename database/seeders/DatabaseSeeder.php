<?php

namespace Database\Seeders;

use App\Models\Imagen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        Storage::deleteDirectory('productos');
        Storage::makeDirectory('productos');
       

        $this->call(InventarioSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductoSeeder::class);
        //$this->call(VentaSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(Orden_compraSeeder::class);

    }
}
