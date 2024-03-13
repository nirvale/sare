<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Dns;

class DnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $dns = Dns::create([
        'dnsname'=>'testdns',
        'cve_servidor'=>'2',
        'dnsip'=>'172.17.4.245',

      ]);
    }
}
