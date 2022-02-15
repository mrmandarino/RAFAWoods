<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        $this->call(InventarioSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(VentaSeeder::class);
        
    }
}
