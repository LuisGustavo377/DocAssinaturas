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
            TiposDeLogradouroSeeder::class,
            TiposDeRenovacaoSeeder::class,
            PlanosSeeder::class,
            GrupoNegocioSeeder::class,
            CargosSeeder::class,
            AdminSeeder::class,
            PessoaFisicaSeeder::class,
            PessoaFisicaTelefoneSeeder::class,
            PessoaFisicaEnderecoSeeder::class,
            PessoaJuridicaSeeder::class,
            PessoaJuridicaTelefoneSeeder::class,
            PessoaJuridicaEnderecoSeeder::class,
            ContratoSeeder::class,
            ArquivoContratoSeeder::class,
            UnidadeDeNegocioSeeder::class,
            LicencaSeeder::class,
            ProprietarioSeeder::class,
            AdicionarIdUnidadeNegocioEmPessoaFisicaSeeder::class,
            
        ]);
    }
}
