<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Localdisco;

class LocaldiscoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $localdisco = Localdisco::create([
          'cve_servidor' => '1',
          'localdisco' => 'sda1',
          'pmontaje' => '/home',
          'cve_dformato' => '1',
          'capacidad' => '500',
          'usado' => '100',
          'usadop' => '20',
          'comontaje' => 'comando montaje',
          'descripcion' => 'descripcion',
        ]);


    }
}
