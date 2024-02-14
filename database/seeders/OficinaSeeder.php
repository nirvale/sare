<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Oficina;

class OficinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $oficina = Oficina::create (['cve_oficina' => '1', 'oficina'  => 'COORDINACIÓN DE GESTIÓN GUBERNAMENTAL']);
      $oficina = Oficina::create (['cve_oficina' => '2', 'oficina'  => 'DIRECCIÓN GENERAL DE TECNOLOGÍAS PARA LA GESTIÓN']);
      $oficina = Oficina::create (['cve_oficina' => '3', 'oficina'  => 'INFRAESTRUCTURA TECNOLÓGICA']);
      $oficina = Oficina::create (['cve_oficina' => '4', 'oficina'  => 'ADMINISTRACIÓN DE PROYECTOS']);
      $oficina = Oficina::create (['cve_oficina' => '5', 'oficina'  => 'PROYECTOS ESTRATÉGICOS']);
      $oficina = Oficina::create (['cve_oficina' => '6', 'oficina'  => 'PROYECTOS ESPECIALES']);
      $oficina = Oficina::create (['cve_oficina' => '7', 'oficina'  => 'ARQUITECTURA TECNOLÓGICA DE PROGRAMAS']);

    }
}
