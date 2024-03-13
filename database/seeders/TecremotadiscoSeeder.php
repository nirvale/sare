<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Tecremotadisco;

class TecremotadiscoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $tecremotadisco = Tecremotadisco::create(['tecremotadisco' => 'NAS']);
      $tecremotadisco = Tecremotadisco::create(['tecremotadisco' => 'SAN']);
      $tecremotadisco = Tecremotadisco::create(['tecremotadisco' => 'CLOUD']);
      $tecremotadisco = Tecremotadisco::create(['tecremotadisco' => 'ORACLE ZFS']);
      $tecremotadisco = Tecremotadisco::create(['tecremotadisco' => 'ORACLE ODA STORAGE']);
    }
}
