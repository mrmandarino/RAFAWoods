<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Trabajador;
use App\Models\Venta;
use Illuminate\Database\Seeder;
use DateTime;
class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //Venta::factory(300)->create();
        
        //2da semana de febrero 2022
        $fecha = '2022-02-07';
        for ($i=1; $i <= 7; $i++) { 
            $fecha_para_transformar_obj = new DateTime($fecha);
            $fecha_un_dia_mas_obj = $fecha_para_transformar_obj->modify('+1 day');
            $fecha_un_dia_mas_str = Date_format($fecha_un_dia_mas_obj, "Y-m-d");
            
            Venta::create([
                
                'sucursal_id' => 1,
                'medio_de_pago' => rand(1, 4),
                'vendedor_rut' => '199670484',
                'total_venta' => rand(150000, 180000),
                'utilidad_bruta' => rand(100000, 130000),
                'con_factura' => rand(1,2),
                'created_at' => $fecha,
            ]);
            $fecha = $fecha_un_dia_mas_str;
        }
        $fecha = '2022-02-07';
        for ($i=1; $i <= 7; $i++) { 
            $fecha_para_transformar_obj = new DateTime($fecha);
            $fecha_un_dia_mas_obj = $fecha_para_transformar_obj->modify('+1 day');
            $fecha_un_dia_mas_str = Date_format($fecha_un_dia_mas_obj, "Y-m-d");
            
            Venta::create([
                
                'sucursal_id' => 1,
                'medio_de_pago' => rand(1, 4),
                'vendedor_rut' => '199670484',
                'total_venta' => rand(150000, 180000),
                'utilidad_bruta' => rand(100000, 130000),
                'con_factura' => rand(1,2),
                'created_at' => $fecha,
            ]);
            $fecha = $fecha_un_dia_mas_str;
        }

        //enero 2022
        $fecha = '2022-01-01';
        for ($i=1; $i <= 31; $i++) { 
            $fecha_para_transformar_obj = new DateTime($fecha);
            $fecha_un_dia_mas_obj = $fecha_para_transformar_obj->modify('+1 day');
            $fecha_un_dia_mas_str = Date_format($fecha_un_dia_mas_obj, "Y-m-d");
            
            Venta::create([
                
                'sucursal_id' => 1,
                'medio_de_pago' => rand(1, 4),
                'vendedor_rut' => '199670484',
                'total_venta' => rand(150000, 180000),
                'utilidad_bruta' => rand(100000, 130000),
                'con_factura' => rand(1,2),
                'created_at' => $fecha,
            ]);
            $fecha = $fecha_un_dia_mas_str;
        }
        $fecha = '2022-01-01';
        for ($i=1; $i <= 31; $i++) { 
            $fecha_para_transformar_obj = new DateTime($fecha);
            $fecha_un_dia_mas_obj = $fecha_para_transformar_obj->modify('+1 day');
            $fecha_un_dia_mas_str = Date_format($fecha_un_dia_mas_obj, "Y-m-d");
            
            Venta::create([
                
                'sucursal_id' => 1,
                'medio_de_pago' => rand(1, 4),
                'vendedor_rut' => '199670484',
                'total_venta' => rand(150000, 180000),
                'utilidad_bruta' => rand(100000, 130000),
                'con_factura' => rand(1,2),
                'created_at' => $fecha,
            ]);
            $fecha = $fecha_un_dia_mas_str;
        }
        
        // 2021
        $fecha = '2021-01-01';
        for ($i=1; $i <= 12; $i++) { 
            $fecha_para_transformar_obj = new DateTime($fecha);
            $fecha_un_dia_mas_obj = $fecha_para_transformar_obj->modify('+1 month');
            $fecha_un_dia_mas_str = Date_format($fecha_un_dia_mas_obj, "Y-m-d");
            
            Venta::create([
                
                'sucursal_id' => 1,
                'medio_de_pago' => rand(1, 4),
                'vendedor_rut' => '199670484',
                'total_venta' => rand(3000000, 6000000),
                'utilidad_bruta' => rand(2000000, 3000000),
                'con_factura' => rand(1,2),
                'created_at' => $fecha,
            ]);
            $fecha = $fecha_un_dia_mas_str;
        }

    }
}
