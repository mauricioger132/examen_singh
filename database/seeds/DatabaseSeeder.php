<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        for($i=0; $i <100; $i++){
            DB::table('empleados')->insert([
                'nombre'=>'Mauricio',
                'apellidos'=>'German',
                'correo' => Str::random(10).'@gmail.com',
                'salario_diario'=>123.42,
                'puesto'=>'Desarrollo',   
                'estatus'=>1,   
            ]);
        }
    }
}
