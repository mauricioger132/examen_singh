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
   
        (empty($request->estatus )) ? $estatus = 0 :$estatus=$request->estatus;
        $data= ['nombre'=>$request->nombre,
                'apellidos'=>$request->apellidos,
                'correo'=>$request->correo,
                'salario_diario'=>$request->salario,
                'puesto'=>$request->puesto,
                'estatus'=>$estatus];

        if(empty($request->id)){ 

            Empleado::create($data);
            return redirect()->route('empleado.inicio')
                             ->with('tipo_alerta', 'success')
                             ->with('mensaje', 'El empleado se guardo correctamente.');  
        }else{ 
            Empleado::where('id',decrypt($request->id))->update($data);
            return redirect()->route('empleado.modficarEmpleado',$request->id)->with('tipo_alerta', 'success')
                                                                            ->with('mensaje', 'El empleado se modifico correctamente.'); 
        }
        
     
    }
    public function eliminarEmpleado(Request $request){
        
        Empleado::where('id',decrypt($request->idempleado))->delete();
        return redirect()->route('empleado.inicio')
                        ->with('tipo_alerta', 'success')
                        ->with('mensaje', 'El empleado elimino correctamente.');    
    }
    public function modficarEmpleado(Request $request){

        $empleados=Empleado::where('id',decrypt($request->id))->first();
       
        return view('empleado.agregarModificar',compact('empleados'));
    }
 
}
