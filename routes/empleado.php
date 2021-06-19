<?php

Route::get('/inicio', 'EmpleadoController@inicio')->name('empleado.inicio');
Route::get('/agregar-modificar', 'EmpleadoController@agrearModificar')->name('empleado.agrearModificar'); // vista alta empleados
Route::get('/modificar-empleado/{id}', 'EmpleadoController@modficarEmpleado')->name('empleado.modficarEmpleado'); // vista alta empleados
Route::post('/agregar-editar', 'EmpleadoController@agregarEditar')->name('empleado.agregarEditar'); // guardar valores
Route::get('/eliminar', 'EmpleadoController@eliminarEmpleado')->name('empleado.eliminar'); // guardar valores o modificarlos

/*Calculo de salario*/
Route::get('/salario-inicio', 'CalculoSalarioController@calculaSalarioInicio')->name('salario.calculaSalarioInicio'); // guardar valores o modificarlos