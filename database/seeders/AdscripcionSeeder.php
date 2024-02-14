<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Adscripcion;

class AdscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $adscripcion=Adscripcion::create(['cve_usuario' => '1', 'cve_oficina'  => '1','cve_estado' => '1']);

    }
}
