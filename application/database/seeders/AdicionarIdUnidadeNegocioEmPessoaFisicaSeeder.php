<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdicionarIdUnidadeNegocioEmPessoaFisicaSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        // Supondo que você queira associar uma unidade de negócio específica a uma pessoa física
        
        $pessoaFisicaId = '0964ad19-09fa-4e04-ba06-75c182411067';
        $unidadeNegocioId = 'a1226e76-3cf6-4278-9875-1a3ed6df5567';

        // Atualize o registro da pessoa física com o ID da unidade de negócio
        DB::table('pessoa_fisica')
            ->where('id', $pessoaFisicaId)
            ->update(['unidade_de_negocio_id' => $unidadeNegocioId]);
    }
}
