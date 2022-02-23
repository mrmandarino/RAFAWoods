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


        return view('graficos.eleccion_fecha');
    }

    public function redireccion(Request $request)
    {
        $request->validate([
            'input_fecha' => ['required'],
            'tipo_grafico' => ['required'],
        ]);

        $tipo_grafico = $request->tipo_grafico;

        if ($tipo_grafico == "grafico_ano") {
            //data del mes 
            $input_fecha = $request->input_fecha;
            $date = new DateTime($input_fecha);
            $ano = $date->format("Y");
            return redirect()->route('grafico_anual', $ano);
        }
        if ($tipo_grafico == "grafico_mes") {
            //data del mes 
            $input_fecha = $request->input_fecha;
            $date = new DateTime($input_fecha);
            $fecha_mes = $date->format("Y-m");
            return redirect()->route('grafico_mes', $fecha_mes);
        } else { //grafico mes     
            //fecha recibida desde graficos.eleccion_fecha
            $input_fecha = $request->input_fecha;
            $date = new DateTime($input_fecha);
            $fecha_semana = $date->format("Y-m-d");
            return redirect()->route('grafico_semana', $fecha_semana);
        }
    }
    public function grafico_anual($ano)
    {
        //data del mes 
        $fechas_arr = []; //fechas de los dias del mes el 2021-01-23 formato mysql
        $fecha_para_transformar_str = $ano . '-' . '01'; //variable que inicial con el dia lunes de la semana elegida y cambia segun se avanza al domingo

        for ($i = 0; $i < 12; $i++) {
            $fecha_para_transformar_obj = new DateTime($fecha_para_transformar_str);
            $fechas_arr[$i] = $fecha_para_transformar_str;
            $fecha_un_dia_mas_obj = $fecha_para_transformar_obj->modify('+1 month');
            $fecha_un_dia_mas_str = Date_format($fecha_un_dia_mas_obj, "Y-m");
            $fecha_para_transformar_str = $fecha_un_dia_mas_str;
        }

        $big_mama = [];
        $ventas_totales = [];
        $utilidad_totales = [];
        $total_ano = 0;
        $total_utilidad_mes = 0;

        for ($i = 0; $i < 12; $i++) {
            $ventas_totales[$i] = DB::table('ventas')->whereDate('created_at', 'like', '%' . $fechas_arr[$i] . '%')->sum('total_venta');
            $utilidad_totales[$i] = DB::table('ventas')->whereDate('created_at', 'like', '%' . $fechas_arr[$i] . '%')->sum('utilidad_bruta');
            $total_ano = $total_ano + DB::table('ventas')->whereDate('created_at', 'like', '%' . $fechas_arr[$i] . '%')->sum('total_venta');
            $total_utilidad_mes = $total_utilidad_mes + DB::table('ventas')->whereDate('created_at', 'like', '%' . $fechas_arr[$i] . '%')->sum('utilidad_bruta');
        }

        $big_mama['ventas_totales'] = $ventas_totales;
        $big_mama['utilidad_totales'] = $utilidad_totales;
        $total_ano_separador = number_format($total_ano, 0, ',', '.');
        $total_utilidad_separador = number_format($total_utilidad_mes, 0, ',', '.');

        $datos_json = json_encode($big_mama);

        //dd($big_mama,$total_ano_separador);
        return view('graficos.graficos_ano', compact('datos_json', 'ano', 'total_ano_separador', 'total_utilidad_separador'));
    }

    public function grafico_mes($fecha_mes)
    {
        //data del mes 
        $date = new DateTime($fecha_mes);
        $year = $date->format("Y");
        $month = $date->format("m");
        $first_day_date = $year . '-' . $month . '-' . '01'; //primer dia del mes
        $last_day_date = date("Y-m-t", strtotime($first_day_date)); //ultimo dia del mes
        $last_day_date_obj = $date = new DateTime($last_day_date);

        $last_day_num = $last_day_date_obj->format("j");

        $numeros_dias_mes = []; //solo los numeros del mes ej 1 2 3 ..31
        $fechas_arr = []; //fechas de los dias del mes el 2021-01-23 formato mysql
        $fecha_para_transformar_str = $first_day_date; //variable que inicial con el dia lunes de la semana elegida y cambia segun se avanza al domingo
        for ($i = 0; $i < $last_day_num; $i++) {
            $fecha_para_transformar_obj = new DateTime($fecha_para_transformar_str);
            $fechas_arr[$i] = $fecha_para_transformar_str;
            $fecha_un_dia_mas_obj = $fecha_para_transformar_obj->modify('+1 day');
            $fecha_un_dia_mas_str = Date_format($fecha_un_dia_mas_obj, "Y-m-d");
            $fecha_para_transformar_str = $fecha_un_dia_mas_str;

            $numeros_dias_mes[$i] = $i + 1;
        }

        $big_mama = [];
        $ventas_totales = [];
        $utilidad_totales = [];
        $total_mes = 0;
        $total_utilidad_mes = 0;

        for ($i = 0; $i < $last_day_num; $i++) {
            //$ventas_totales[$numeros_dias_mes[$i]] = DB::table('ventas')->whereDate('created_at', $fechas_arr[$i])->sum('total_venta'); 
            $ventas_totales[$i] = DB::table('ventas')->whereDate('created_at', $fechas_arr[$i])->sum('total_venta');
            $utilidad_totales[$i] = DB::table('ventas')->whereDate('created_at', $fechas_arr[$i])->sum('utilidad_bruta');
            $total_mes = $total_mes + DB::table('ventas')->whereDate('created_at', $fechas_arr[$i])->sum('total_venta');
            $total_utilidad_mes = $total_utilidad_mes + DB::table('ventas')->whereDate('created_at', $fechas_arr[$i])->sum('utilidad_bruta');
        }

        $big_mama['num_dias'] = $numeros_dias_mes;
        $big_mama['ventas_totales'] = $ventas_totales;
        $big_mama['utilidad_totales'] = $utilidad_totales;
        $total_mes_separador = number_format($total_mes, 0, ',', '.');
        $total_utilidad_separador = number_format($total_utilidad_mes, 0, ',', '.');

        $datos_json = json_encode($big_mama);

        //dd($big_mama,$total_mes_separador);
        return view('graficos.graficos_mes', compact('datos_json', 'year', 'month', 'total_mes_separador', 'total_utilidad_separador'));
    }

    public function grafico_semana($fecha_semana)
    {
        $date = new DateTime($fecha_semana);
        $year = $date->format("Y");
        $month = $date->format("m");
        $week = $date->format("W");
        $day = $date->format("d");

        //transformar info de request en datos para query
        $fecha_init = date_create(); //instancia en blanco de un objeto tipo date
        $fecha_inicio_semana = date_isodate_set($fecha_init, $year, $week); //aqui poner el ano y el numero de semana obtenidos desde el formulario del menu_graficos
        $fecha_inicio_semana_mysql = Date_format($fecha_inicio_semana, "Y-m-d"); //fecha en formato string con el formato de mysql excluyendo la hora para que calce con los dias almacenados en la base de datos

        $fecha_lunes_str = $fecha_inicio_semana_mysql;
        $fecha_lunes_obj = new DateTime($fecha_lunes_str); //fecha lunes tipo objeto para usar en indices para bigmama

        //data para armar el JSON
        $dias = ["lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domingo"];
        $numeros_semana = [Date_format($fecha_lunes_obj, "j")]; // numeros de los dias de la semana ej: 21 21 23 ...
        $fechas_arr = [$fecha_lunes_str]; //arreglo con todas las fechas yyyy-mm-dd que serán usadas para las querys de calcular el valor total de ventas por dias

        $fecha_para_transformar_str = $fecha_lunes_str; //variable que inicial con el dia lunes de la semana elegida y cambia segun se avanza al domingo
        for ($i = 1; $i < 7; $i++) {
            $fecha_para_transformar_obj = new DateTime($fecha_para_transformar_str);
            $fecha_un_dia_mas_obj = $fecha_para_transformar_obj->modify('+1 day');
            $fecha_un_dia_mas_str = Date_format($fecha_un_dia_mas_obj, "Y-m-d");
            $numeros_semana[$i] = Date_format($fecha_un_dia_mas_obj, "j"); //guardar los numeros de los dias de semana ej: 21 22 23...
            $fechas_arr[$i] = $fecha_un_dia_mas_str;
            $fecha_para_transformar_str = $fecha_un_dia_mas_str;
        }

        $big_mama = [];
        $num_dias = [];
        $ventas_totales = [];
        $utilidad_totales = [];
        $total_semana = 0;
        $total_utilidad_semana = 0;

        for ($i = 0; $i < 7; $i++) {

            $num_dias[$dias[$i]] = $numeros_semana[$i];
            $ventas_totales[$dias[$i]] = DB::table('ventas')->whereDate('created_at', $fechas_arr[$i])->sum('total_venta');
            $utilidad_totales[$dias[$i]] = DB::table('ventas')->whereDate('created_at', $fechas_arr[$i])->sum('utilidad_bruta');
            $total_semana = $total_semana + DB::table('ventas')->whereDate('created_at', $fechas_arr[$i])->sum('total_venta');
            $total_utilidad_semana = $total_utilidad_semana + DB::table('ventas')->whereDate('created_at', $fechas_arr[$i])->sum('utilidad_bruta');
        }

        $big_mama['num_dias'] = $num_dias;
        $big_mama['ventas_totales'] = $ventas_totales;
        $big_mama['total_utilidad_semana'] = $utilidad_totales;
        $total_semana_separador = number_format($total_semana, 0, ',', '.');
        $total_utilidad_separador = number_format($total_utilidad_semana, 0, ',', '.');

        //dd($big_mama);

        $datos_json = json_encode($big_mama);
        return view('graficos.graficos_semana', compact('datos_json', 'year', 'month', 'day', 'total_semana_separador', 'total_utilidad_separador'));
    }
}
