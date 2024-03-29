<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            DependenciaSeeder::class,
            DominioSeeder::class,
            TnicSeeder::class,
            ProgramaSeeder::class,
            OficinaSeeder::class,
            EstadoSeeder::class,
            AdscripcionSeeder::class,
            BackupSeeder::class,
            EstadoesquemaSeeder::class,
            TipodcSeeder::class,
            TipoSeeder::class,
            RdbmsSeeder::class,
            OsSeeder::class,
            DatacenterSeeder::class,
            EstadobackupSeeder::class,
            EstatusRecoverTestSeeder::class,
            TecremotadiscoSeeder::class,
            DformatoSeeder::class,
            TdiscoSeeder::class,
            AmbienteSeeder::class,
            DistribucionSeeder::class,
            AprocesadorSeeder::class,
            MhardwareSeeder::class,
            UdremotaSeeder::class,
            StorageremotoSeeder::class,
            VirtualizadorSeeder::class,
            MprocesadorSeeder::class,
            ProcesadorSeeder::class,
            OsVersionSeeder::class,
            RdbmsVersionSeeder::class,
            ServidorSeeder::class,
            LocaldiscoSeeder::class,
            RemotodiscoSeeder::class,
            DnsSeeder::class,
            NicSeeder::class,
            BaseSeeder::class,


        ]);
    }
}
