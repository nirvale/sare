<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\RdbmsVersion;


class RdbmsVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rdbmsversion = RdbmsVersion::create(['cve_rdbms' => '1','rdbmsversion' => '12.0.2.0.4 EE']);
        $rdbmsversion = RdbmsVersion::create(['cve_rdbms' => '1','rdbmsversion' => '18.7.0.0.0 EE']);
        $rdbmsversion = RdbmsVersion::create(['cve_rdbms' => '1','rdbmsversion' => '19.13.0.0.0 EE']);
        $rdbmsversion = RdbmsVersion::create(['cve_rdbms' => '3','rdbmsversion' => '10.6.15-MariaDB']);
        $rdbmsversion = RdbmsVersion::create(['cve_rdbms' => '4','rdbmsversion' => 'Cambiar versión postgress']);

    }
}
