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
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-hover mb-0" id="tbllist" >
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Correo</th>
                                        <th>Puesto</th>
                                        <th>Calculo de salario</th>
                                    </tr>
                                </thead>
                                <tbody> </tbody>
                            </table>
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
                <h5 class="modal-title" id="exampleModalLabel">Calcular nómina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="forminfo">
                    <div class="form-group">
                        <select class="form-control form-control-sm" id="calculaN" >
                            <option>Selecciona una opción</option>
                            <option value="1">Semanal</option>
                            <option value="2">Quincenal</option>
                            <option value="3">Mensual</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Nombre completo</label>
                        <input type="text"  id="nombrecompleto" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label id="customp"></label>
                        <input type="text"  id="totalsalario" class="form-control" disabled>
                    </div>
                    <input type="hidden" id="salariodiario">
                </form>
            </div>
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

                @php $parametros= 'calcularNomina(\''.$empleado->salario_diario.'\',\''.$empleado->nombre.'\',\''.$empleado->apellidos.'\')' @endphp
                @php $select='<div type="button" class="btn btn-dark btn-sm"  onclick="'.$parametros.'"><span><i class="fa fa-book" data-toggle="tooltip" data-placement="right" title="Eliminar activo" ></i></span></div>' @endphp
                @php $data[]=['0'=>$empleado->nombre, 
                            '1'=>$empleado->apellidos,
                            '2'=>$empleado->correo,
                            '3'=>$empleado->puesto,
                            '4'=>$select] 
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
               { puesto: "puesto" },
               { calculo: "calculo" },
                     
           ],
       });
       $('#calculaN').on('change', function() {
            
            let salario=$("#salariodiario").val();
            let resultado='';
            let mensaje='';
            switch(this.value){
                case '2':
                    mensaje='Salario quincenal'
                    resultado= salario * 7 * 2 ;
                break;
                case '3':
                    mensaje='Salario mensual'
                    resultado= salario * 30 ;
                break;
                default:
                    mensaje='Salario semanal'
                    resultado= salario * 7;
                
                break;
            }
            customp
            $("#customp").append(mensaje);
            $("#totalsalario").val('$ '+resultado+ ' '+'MXN' );
        });
   });
   const calcularNomina=(salario,nombre,apellidos)=>{
        
        $("#forminfo")[0].reset();
        $("#modalempleado").modal('show');
        $("#salariodiario").val(salario);
        $("#nombrecompleto").val(`${nombre} ${apellidos}`);
    }    
</script>
@endsection