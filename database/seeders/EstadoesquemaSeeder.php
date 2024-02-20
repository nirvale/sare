<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dbam\Estadoesquema;

class EstadoesquemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadoesquema = Estadoesquema::create(['estadoesquema' => 'ACTIVO']);
        $estadoesquema = Estadoesquema::create(['estadoesquema' => 'INACTIVO']);
        $estadoesquema = Estadoesquema::create(['estadoesquema' => 'BORRADO']);
        $estadoesquema = Estadoesquema::create(['estadoesquema' => 'BLOQUEADO']);
    }

}
