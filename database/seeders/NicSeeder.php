<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Nic;

class NicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $nic = Nic::create([
        'nic'=>'nic1-pub',
        'cve_servidor' => '1',
        'cve_tnic' => '1',
        'ip' => '172.17.4.236',
        'cve_dns1' => '1',
        'cve_dns2' => null,
        'cve_dns3' => null,
        'gateway' => '172.17.4.254',
        'mac' => 'sdfdssadfasd',
        'netmask' => '255.255.255.0',
        'descripcion' => 'test',
      ]);
      $nic = Nic::create([
        'nic'=>'nic2-pub',
        'cve_servidor' => '1',
        'cve_tnic' => '1',
        'ip' => '172.17.4.235',
        'cve_dns1' => '1',
        'cve_dns2' => null,
        'cve_dns3' => null,
        'gateway' => '172.17.4.254',
        'mac' => 'MAC1',
        'netmask' => '255.255.255.0',
        'descripcion' => 'test',
      ]);
    }
}
