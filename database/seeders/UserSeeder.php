<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $user = User::create([
         'name' => 'Administrador de Sistema',
         'email' => 'admindba@cggedomex.gob.mx',
         'password' => Hash::make('caperucitaputa'),
         'id' => 1
     ])->syncRoles(['God']);
    }
}
