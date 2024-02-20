<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Tipodc;

class TipodcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipodc = Tipodc::create(['tipodc' => 'FISICO']);
        $tipodc = Tipodc::create(['tipodc' => 'CLOUD']);
    }
}
