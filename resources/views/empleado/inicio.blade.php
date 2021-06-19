@extends('plantilla_inicio')
@section('titulo') | Empleado @endsection
@section('additional_css')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> <a href="{{route('empleado.agrearModificar')}}"><div class="btn btn-secondary btn-sm ">Crear empleado</div></a></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-hover mb-0" id="tbllist" >
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                            <th>Salario </th>
                                            <th>Puesto</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>    
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 offset-md-1 mt-4">
                @if (session('mensaje'))
                    <div class="alert alert-{{ session('tipo_alerta', 'secondary') }}" role="alert" id="alerta">
                        {!! session('mensaje') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <script> setTimeout(()=> $('#alerta').fadeOut(), 3000); </script>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalempleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('empleado.eliminar')}}" method="get" >
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="idempleado" id="idempleado">
                    <input type="hidden" name="estatus" id="estatus">
                    <div class="alert alert-danger" role="alert" id="custom-p"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('additional_javascript')

<script>
$(function(){
    let datos="";
    @if(count($empleados) > 0)

        @php $data=[] @endphp
        @foreach($empleados as $empleado )
            @php $ruta=route('empleado.modficarEmpleado',Crypt::encrypt($empleado->id))  @endphp
            @php $parametros= 'eliminarEmpleado(\''.Crypt::encrypt($empleado->id).'\',\''.$empleado->estatus.'\',\''.$empleado->nombre.'\')' @endphp
            @php $acciones ='<div type="button" class="btn btn-danger btn-sm"  onclick="'.$parametros.'"><span><i class="fa fa-trash-alt" data-toggle="tooltip" data-placement="right" title="Eliminar activo" ></i></span></div> <a href='.$ruta.' class="btn btn-warning btn-sm"  data-toggle="tooltip" data-placement="right" title="Modificar encuesta"><span><i class="fas fa-pencil-alt" ></i></span></a>' @endphp
    
            @php $data[]=['0'=>$empleado->nombre, 
                        '1'=>$empleado->apellidos,
                        '2'=>$empleado->correo,
                        '3'=>$empleado->salario_diario,
                        '4'=>$empleado->puesto,
                        '5'=>($empleado->estatus=="1")? '<span style="color:green"> Activo </span>' : '<span style="color:red"> Inactivo </span>' ,
                        '6'=>$acciones] 
            @endphp

        @endforeach
        datos = @php echo json_encode($data) @endphp
        
    @else
        datos=[];
    @endif

    $('#tbllist').DataTable( {

        "aProcessing":true,
        "aServerside":true,
        "paging":   false,
        "ordering": false,
        data:datos ,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        columns: [
            { nombre: "nombre" },
            { apellidos: "apellidos" },
            { correo: "correo" },
            { salario:"salario" },
            { puesto: "puesto" },
            { estatus: "estatus" },
            { acciones: "acciones" },            
        ],
    });
});
const eliminarEmpleado=(id,estatus,nombre)=>{

    $("#modalempleado").modal('show');
    $("#idempleado").val(id);
    $("#estatus").val(estatus);
    $("#custom-p").empty();
    let mensaje="";
    (estatus=="1")? mensaje='¿ Estás seguro de eliminar este empleado con el nombre' : mensaje='¿ Estás seguro de habilitar el  activo con el nombre';
    $("#custom-p").append(`${mensaje} <strong>${nombre}</strong> ?` );
}
</script>
@endsection