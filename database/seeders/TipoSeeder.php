<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tipo;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = Tipo::create(['tipo' => 'DESARROLLO']);
        $tipo = Tipo::create(['tipo' => 'PRUEBAS']);
        $tipo = Tipo::create(['tipo' => 'PRODUCCIÓN']);
    }
}
