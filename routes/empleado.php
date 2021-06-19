<?php

Route::get('/inicio', 'EmpleadoController@inicio')->name('empleado.inicio');
Route::get('/agregar-modificar', 'EmpleadoController@agrearModificar')->name('empleado.agrearModificar'); // vista alta empleados/ modificacion
Route::post('/agregar-editar', 'EmpleadoController@agregarEditar')->name('empleado.agregarEditar'); // guardar valores o modificarlos
Route::get('/eliminar', 'EmpleadoController@eliminarEmpleado')->name('empleado.eliminar'); // guardar valores o modificarlos