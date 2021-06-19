<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Empleado;

class EmpleadoController extends Controller
{
    public function inicio(){

        $empleados=Empleado::all();
        return view('empleado.inicio',compact('empleados'));
    }
    public function agrearModificar(){
        return view('empleado.agregarModificar');
    }
    public function agregarEditar(Request $request){
    
        ($request->estatus ==="") ? $request->estatus== 1 : $request->estatus; 
         Empleado::create(['nombre'=>$request->nombre,
                          'apellidos'=>$request->apellidos,
                          'correo'=>$request->correo,
                          'salario_diario'=>$request->salario,
                          'puesto'=>$request->puesto,
                          'estatus'=>$request->estatus]);
        
        return redirect()->route('empleado.inicio')
                         ->with('tipo_alerta', 'success')
                         ->with('mensaje', 'El empleado se guardo correctamente.'); 
    }
    public function eliminarEmpleado(Request $request){
        
        Empleado::where('id',decrypt($request->idempleado))->delete();
        return redirect()->route('empleado.inicio')
                        ->with('tipo_alerta', 'success')
                        ->with('mensaje', 'El empleado elimino correctamente.');    
    }
}
