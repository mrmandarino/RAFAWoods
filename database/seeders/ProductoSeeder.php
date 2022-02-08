<?php

namespace Database\Seeders;

use App\Models\Clavo;
use App\Models\Imagen;
use App\Models\Localizacion;
use App\Models\Madera;
use App\Models\Mueble;
use App\Models\Producto;
use App\Models\Tornillo;
use App\Models\Techumbre;
use App\Models\Localizacion;
use Illuminate\Database\Seeder;
use App\Models\Plancha_construccion;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.$familias=['Plancha_construccion','Techumbre', 'Mueble', 'Tornillo','Clavo','Madera'];
     *
     * @return void
     */
    public function run()
    {
        $material_clavos=['Alambre de Acero','Acero Templado y pulido','Acero Inoxidable','Latonados y de latón','Cobre'];
        $material_planchas=['Cielo Falso','Fibrocemento','Siding','Yeso Carton','OSB','OLB'];
        $maderas=['Abeto','Pino','Cedro','Arce','Haya','Fresno','Nogal','Cerezo','Roble','Caoba','Teca']; //maderas más utilizadas
        $tratamientos=['Pincelado','Pulverizado','Inmersión breve','Termotratada','Acetilada','Furfurilada']; //tratamientos más utilizadas
        $material_techumbres=['zinc','material_2','material_3','material_4'];
        $punta_tornillos=['punta de broca','punta fina','punta de espada'];
        $punta_clavos=['de cincel o diamante','plana','biselada'];
        $acabados=['Aceite de tung','Aceite de linaza','Aceite danés','Aceite de cedro', //hasta aquí son acabados penetrantes
    'Goma laca','Laca','Barniz','Cera','Poliuretano','Teñir','Pulido francés','Acabado a base de agua','Pintura']; //acabados superficiales
        
        $productos=Producto::factory(20)->create();
        foreach ($productos as $producto){
            Localizacion::create([
                'sucursal_id' => 1,
                'producto_id' => $producto->id,
                'stock' => rand(50,100),
                'precio_compra' => rand(5000,10000),
                'precio_venta' => rand(8000,15000)
            ]);
            Imagen::factory(1)->create([
                'imagenable_id' => $producto->id,
                'imagenable_tipo' => 'App\Models\Producto'
            ]);
            if($producto->familia == 'Plancha_construccion'){ 
                Plancha_construccion::create([
                    'producto_id' => $producto->id,
                    'material' => $material_planchas[rand(0,count($material_planchas)-1)],
                    'ancho' => rand(60,100),
                    'largo' => rand(120,240),
                    'alto' => 0.8
                ]);
            }elseif ($producto->familia == 'Techumbre') {
                Techumbre::create([
                    'producto_id' => $producto->id,
                    'material' => $material_techumbres[rand(0,count($material_techumbres)-1)],
                    'ancho' => rand(60,100),
                    'largo' => rand(120,240),
                    'alto' => 0.8
                ]);
            }elseif ($producto->familia == 'Mueble') {
                Mueble::create([
                    'producto_id' => $producto->id,
                    'material' => 'Madera de '. $maderas[rand(0,count($maderas)-1)],
                    'acabado' => $acabados[rand(0,count($acabados)-1)],
                    'ancho' => rand(25,90),
                    'largo' => rand(80,120),
                    'alto' => rand(70,90)
                ]);
            }elseif ($producto->familia == 'Tornillo') {
                Tornillo::create([
                    'producto_id' => $producto->id,
                    'cabeza' => rand(1,5),
                    'tipo_rosca' => rand(Tornillo::completa,Tornillo::parcial),
                    'separacion_rosca' => rand(1,3),
                    'punta' => $punta_tornillos[rand(0,count($punta_tornillos)-1)],
                    'vastago' => rand(50,70)
                ]);
            }elseif ($producto->familia == 'Clavo') {
                Clavo::create([
                    'producto_id' => $producto->id,
                    'material' => $material_clavos[rand(0,count($material_clavos)-1)],
                    'cabeza' => rand(1,5),
                    'punta' => $punta_clavos[rand(0,count($punta_clavos)-1)],
                    'longitud' => rand(70,90)
                ]);
            }elseif ($producto->familia == 'Madera') {
                Madera::create([
                    'producto_id' => $producto->id,
                    'alto' => rand(2,7),
                    'ancho' => rand(10,30),
                    'largo' => rand(2,10),
                    'tipo_madera' => $maderas[rand(0,count($maderas)-1)],
                    'tratamiento' => $tratamientos[rand(0,count($tratamientos)-1)]
                ]);
            }
            
        }
    }
}
