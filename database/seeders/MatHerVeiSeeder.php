<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MatHerVeiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mat_her_veis')->insert([
            ['materiales' => 'Materiales De Ferreteria'],
            ['materiales' => 'Ariddos'],
            ['materiales' => 'Especies Vegetales'],
            ['materiales' => 'Quimicos'],
            ['materiales' => 'Articulos De Aseo'],
            ['materiales' => 'Disponibilidad Presupuestaria'],
            ['materiales' => 'Herramientas Manuales'],
            ['materiales' => 'Herramientas Motorizadas'],
            ['materiales' => 'Repuestos Maquinaria'],
            ['materiales' => 'Repuestos Vehiculos'],
            ['materiales' => 'Lubricantes y Filtros'],
            ['materiales' => 'Neumaticos'],
            ['materiales' => 'Combustible'],
            ['materiales' => 'Otros'],
        ]);

        DB::table('users')->insert([
            'name' => 'AnotherDream',
            'email' => 'Another@Dream.com',
            'password' => Hash::make('123456789'),
        ]);

        DB::table('users')->insert([
            'name' => 'Cristian',
            'email' => 'cverdugo@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
