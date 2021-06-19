@extends('plantilla_inicio')
@section('titulo') | Empleado agregar @endsection
@section('additional_css')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> <a href="{{route('empleado.inicio')}}"><div class="btn btn-dark btn-sm ">Regresar</div></a></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('empleado.agregarEditar')}}" method="post" >
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" placeholder="Ej. Mauricio " value="{{ !empty($empleados['nombre'])? $empleados['nombre'] : ''}}" required>
                                    </div>
                                  <div class="form-group col-md-4">
                                        <label>Apellidos</label>
                                        <input type="text" class="form-control form-control-sm" name="apellidos" id="apellidos" placeholder="Ej. German Alvarado" value="{{ !empty($empleados['apellidos'])? $empleados['apellidos'] : ''}}" required>
                                  </div>
                                  <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <input type="email" class="form-control form-control-sm" name="correo" id="correo" placeholder="Ej. ejem@gmail.com" value="{{ !empty($empleados['correo'])? $empleados['correo'] : ''}}" required >
                                </div>
                                </div>
                          
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label>Salario</label>
                                    <input type="text" class="form-control form-control-sm" name="salario" id="salario" placeholder="Ej. 123.43" value="{{ !empty($empleados['salario_diario'])? $empleados['salario_diario'] : ''}}"  required>
                                  </div>
                                
                                  <div class="form-group col-md-6">
                                    <label>Puesto</label>
                                    <input type="text" class="form-control form-control-sm" name="puesto" id="puesto" placeholder="Ej. Desarrollo" value="{{ !empty($empleados['puesto'])? $empleados['puesto'] : ''}}"  required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="activo" {{(!empty($empleados['estatus']) && $empleados['estatus'] =='1' ) ? $checked='checked' : $checked=''}}  >
                                    <label class="form-check-label">
                                      Estatus
                                    </label>
                                    <input type="hidden" name="estatus" id="estatus">
                                    <input type="hidden" name="id" id="id" value="{{ !empty($empleados['id'])? Crypt::encrypt( $empleados['id']) : ''}}">
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Guardar </button>
                              </form>
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
    </div>
</div>
@endsection
@section('additional_javascript')

<script>
    $(function(){

        $('#activo').click(()=>{

            let activo = document.getElementById('estatus');
            (document.getElementById('activo').checked ) ? activo.value=1 :activo.value=0 ;
        });
    });
</script>
@endsection