<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Storageremoto;

class StorageremotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $storageremoto = Storageremoto::create(['storageremoto' => 'ORACLE ODA-X5','cve_tecremotadisco' => '3','cve_mhardware' => '1','cve_datacenter' => '2', 'capacidad' => '190000','usado' => '105360','usadop' => '55.45']);
      $storageremoto->udremotas()->sync([1,2,3]);
      $storageremoto = Storageremoto::create(['storageremoto' => 'IBM-XIV','cve_tecremotadisco' => '1','cve_mhardware' => '1','cve_datacenter' => '2', 'capacidad' => '190000','usado' => '100000','usadop' => '26.31']);
      $storageremoto->udremotas()->sync([3,4]);



    }
}
