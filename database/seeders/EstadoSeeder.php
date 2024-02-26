<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $estado = Estado::create (['id' => '0', 'estado'  => 'INACTIVO']);
      $estado = Estado::create (['id' => '1', 'estado'  => 'ACTIVO']);
    }
}
