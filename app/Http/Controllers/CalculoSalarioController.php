<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;

class CalculoSalarioController extends Controller
{
    public function calculaSalarioInicio(){
        $empleados=Empleado::all();
        return view('calculaSalario.inicio',compact('empleados'));
    }
}
