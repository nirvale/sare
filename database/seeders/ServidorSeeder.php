<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Servidor;

class ServidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $servidor = Servidor::create([
                  'hostname' => 'test',
                  'memoria' => '2gb',
                  'procesadores' => '2',
                  //'nucleos' => '2',
                  'cve_procesador' => '1',
                  //'velocidad_procesador' => '2.8ghz',
                  //'cve_mprocesador' => '1',
                  //'cve_aprocesador' => '1',
                  //'cve_os' => '1',
                  //'cve_distribucion' => '1',
                  'cve_osversion' => '1',
                  'cve_ambiente' => '1',
                  'cve_datacenter' => '1',
                  'cve_tipo' => '1',
                  'cve_virtualizador' => '1',
                  'cve_mhardware' => '1',
                  'cve_dominio' => '1',
                  'descripcion' => 'test'

                ]);
                $servidor = Servidor::create([
                  'hostname' => 'dnsdummy',
                  'memoria' => '2gb',
                  'procesadores' => '2',
                  'cve_procesador' => '1',
                  'cve_osversion' => '1',
                  'cve_ambiente' => '2',
                  'cve_datacenter' => '1',
                  'cve_tipo' => '1',
                  'cve_virtualizador' => '1',
                  'cve_mhardware' => '2',
                  'cve_dominio' => '1',
                  'descripcion' => 'test dummy para dns'

                ]);
    }
}
