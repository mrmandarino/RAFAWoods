<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraficoController extends Controller
{
    
    public function index()
    {
        $current_year = date("Y");
        $year_m1 = strval($current_year-1);
        $year_m2 = strval($current_year-2);
        $year_m3 = strval($current_year-3);
        $year_m4 = strval($current_year-4);
        $years_arr = [$current_year,$year_m1,$year_m2,$year_m3,$year_m4];

    return view('graficos.menu_graficos',compact('years_arr'));
    }
    
}
