<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Remotodisco;

class RemotodiscoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $remotodisco = Remotodisco::create([
        'cve_storageremoto' => '1',
        'cve_servidor' => '1',
        'cve_udremota' => '2',
        'remotodisco' => 'sda1',
        'pmontaje' => '/home',
        'cve_dformato' => '1',
        'capacidad' => '1560',
        'usado' => '100',
        'usadop' => '20',
        'comontaje' => 'comando montaje',
        'descripcion' => 'descripcion',
      ]);
    }
}
