<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EstadosTableSeeder::class,
            CidadesTableSeeder::class,
            BancosSeeder::class,
            TiposRelacionamentoSeeder::class,
            TiposTransacaoSeeder::class,
            TiposCobrancaSeeder::class,
            GrupoNegocioSeeder::class
        ]);
    }
}
