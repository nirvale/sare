<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Estadobackup;

class EstadobackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $eb = Estadobackup::create(['estadobackup' => 'DISPONIBLE']);
          $eb = Estadobackup::create(['estadobackup' => 'PENDIENTE']);
          $eb = Estadobackup::create(['estadobackup' => 'OBSOLETO']);
    }
}
