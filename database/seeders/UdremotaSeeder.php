<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Udremota;

class UdremotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $udremota = Udremota::create(['udremota' => 'NFS']);
      $udremota = Udremota::create(['udremota' => 'ASMFS']);
      $udremota = Udremota::create(['udremota' => 'SAMBA']);
      $udremota = Udremota::create(['udremota' => 'ISCSI']);
    }
}
