<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class GraficoController extends Controller
{
    /*
        metodo que carga la vista menu_graficos, la cual permite elegir entre un tipo de 
         grafico por mes o por semana, envia el año actual para carga ese y los 4 años anteriores
        para mostrarlos como opcion al enviar la seleccion de graficos
    */
    public function index()
    {
        $current_year = date("Y");
        $year_m1 = strval($current_year - 1);
        $year_m2 = strval($current_year - 2);
        $year_m3 = strval($current_year - 3);
        $year_m4 = strval($current_year - 4);
        $years_arr = [$current_year, $year_m1, $year_m2, $year_m3, $year_m4];

        return view('graficos.menu_graficos', compact('years_arr'));
    }

    /*
        metodo que toma la opcion recibida por la vista menu_graficos
        y redirige a la vista con el grafico por semana o por mes, según
        la opción ingresada.

        tipo_grafico = 0 es grafico por mes
        tipo_grafico = 1 es grafico por semana

        de la manera en que se hacen las consultas de los valores totales por dia, 
        cuando se intenta conseguir el total de ventas de un dia que no tuvo ventas
        no se cae el programa, simplemente arroja 0.
    */
    public function redireccion(Request $request)
    {
        //dd($request);
        $tipo_grafico = $request->tipo_grafico;

        if ($tipo_grafico == 0) {
            //data del mes 
            return view('graficos.graficos_mes');
        } 
        else {
            //data de la semana
            $ano = $request->ano;
            $mes = $request->mes;
            $semana = $request->option_semana;
            $datos = [$ano, $mes, $semana];

            $semana_del_ano = $semana;
            if($mes!=1)
            {
                if($mes==12 and $semana==4){//mes de diciembre

                    $semana_del_ano = ($mes * 4) + $semana;
                }
                else{

                    $semana_del_ano = (($mes-1) * 4) + $semana;
                }
            }



            //suponiendo que se resive ahora una fecha
            $ddate = '2021-12-28';
            $date = new DateTime($ddate);
            
            $week = $date->format("W");
            $fecha_test = date_create();
            $fecha_de_semana_test = date_isodate_set($fecha_test, 2021, $week);//aqui poner el ano y el numero de semana obtenidos desde el formulario del menu_graficos
            //dd($fecha_de_semana_test);
            


            //transformar info de request en datos para query
            $fecha_init = date_create();
            //$fecha_de_semana = date_isodate_set($fecha_init, 2021, 3);//aqui poner el ano y el numero de semana obtenidos desde el formulario del menu_graficos
            $fecha_de_semana = date_isodate_set($fecha_init, $ano, $semana_del_ano);//aqui poner el ano y el numero de semana obtenidos desde el formulario del menu_graficos
            $fecha_inicio_semana_mysql = Date_format($fecha_de_semana, "Y-m-d");//fecha en formato string con el formato de mysql excluyendo la hora para que calce con los dias almacenados en la base de datos

            //ya teniendo lo anterior listo          
            $fecha_lunes_str = $fecha_inicio_semana_mysql;
            $fecha_lunes_obj = new DateTime($fecha_lunes_str);//fecha lunes tipo objeto para usar en indices para bigmama
            
            //data para armar el JSON
            $dias=["lunes","martes","miercoles","jueves","viernes","sabado","domingo"];
            $numeros_semana =[Date_format($fecha_lunes_obj, "j")];// numeros de los dias de la semana ej: 21 21 23 ...
            $fechas_arr = [$fecha_lunes_str];//arreglo con todas las fechas yyyy-mm-dd que serán usadas para las querys de calcular el valor total de ventas por dias
            
            $fecha_para_transformar_str = $fecha_lunes_str; //variable que inicial con el dia lunes de la semana elegida y cambia segun se avanza al domingo
            for ($i=1; $i <7 ; $i++) { 
                $fecha_para_transformar_obj = new DateTime($fecha_para_transformar_str);
                $fecha_un_dia_mas_obj = $fecha_para_transformar_obj->modify('+1 day');
                $fecha_un_dia_mas_str = Date_format($fecha_un_dia_mas_obj, "Y-m-d");
                $numeros_semana[$i] = Date_format($fecha_un_dia_mas_obj, "j");//guardar los numeros de los dias de semana ej: 21 22 23...
                $fechas_arr[$i] = $fecha_un_dia_mas_str;
                $fecha_para_transformar_str = $fecha_un_dia_mas_str;

            }
            
            $big_mama = [];       
            $num_dias = [];
            $ventas_totales = [];
                    
            
            for ($i=0; $i < 7; $i++) { 
                
                $num_dias[$dias[$i]] = $numeros_semana[$i]; 
                $ventas_totales[$dias[$i]] = DB::table('ventas')->whereDate('created_at', $fechas_arr[$i])->sum('total_venta'); 
                
            }
            
            $big_mama['num_dias'] = $num_dias;
            $big_mama['ventas_totales'] = $ventas_totales;

            //dd($big_mama);
     
            $datos_json = json_encode($big_mama);
            return view('graficos.graficos_semana',compact('datos_json','ano','mes','semana'));
        }
    }
}
