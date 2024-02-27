<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Backup;

class BackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backup = Backup::create(['backup' => 'AUTOMÁTICO DIARIO (L-V)','descripcion' => 'RESPALDO AUTOMATIZADO PARA EJECUTARSE DE LUNES A VIERNES A LAS 22:00 HORAS']);
        $backup = Backup::create(['backup' => 'AUTOMÁTICO SEMANAL (S)','descripcion' => 'RESPALDO AUTOMATIZADO PARA EJECUTARSE LOS DIAS SÁBADOS A LAS 22:00 HORAS']);
        $backup = Backup::create(['backup' => 'MANUAL','descripcion' => 'RESPALDO MANUAL A PETICIÓN DEL USUARIO']);
        $backup = Backup::create(['backup' => 'NINGUNO','descripcion' => 'ESQUEMA DE PRUEBAS O DESARROLLO, SIN BACKUP']);
    }
}
