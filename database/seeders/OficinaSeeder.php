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
      $oficina = Oficina::create (['oficina'  => 'COORDINACIÓN DE GESTIÓN GUBERNAMENTAL']);
      $oficina = Oficina::create (['oficina'  => 'DIRECCIÓN GENERAL DE TECNOLOGÍAS PARA LA GESTIÓN']);
      $oficina = Oficina::create (['oficina'  => 'INFRAESTRUCTURA TECNOLÓGICA']);
      $oficina = Oficina::create (['oficina'  => 'ADMINISTRACIÓN DE PROYECTOS']);
      $oficina = Oficina::create (['oficina'  => 'PROYECTOS ESTRATÉGICOS']);
      $oficina = Oficina::create (['oficina'  => 'PROYECTOS ESPECIALES']);
      $oficina = Oficina::create (['oficina'  => 'ARQUITECTURA TECNOLÓGICA DE PROGRAMAS']);

    }
}
