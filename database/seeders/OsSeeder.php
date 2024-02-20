<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Os;

class OsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $os = Os::create(['os' => 'AIX']);
        $os = Os::create(['os' => 'LINUX']);
        $os = Os::create(['os' => 'WINDOWS']);
    }
}
