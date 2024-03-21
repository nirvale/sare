<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Dformato;

class DformatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $dformato = Dformato::create(['dformato' => 'ntfs']);
      $dformato = Dformato::create(['dformato' => 'fat']);
      $dformato = Dformato::create(['dformato' => 'fat32']);
      $dformato = Dformato::create(['dformato' => 'ext3']);
      $dformato = Dformato::create(['dformato' => 'ext4']);
    }
}
