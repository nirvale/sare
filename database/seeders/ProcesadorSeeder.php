<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Procesador;


class ProcesadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $procesador = Procesador::create([
            'procesador'=>'RYZEN 7 5400U',
            'nucleos' => '2',
            'velocidad' => '2.8ghz',
            'cve_mprocesador' => '1',
            'cve_aprocesador' => '1',
      ]);
    }
}
