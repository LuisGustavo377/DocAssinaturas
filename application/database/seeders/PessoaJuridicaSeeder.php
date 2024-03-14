<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PessoaJuridicaSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $pessoaJuridica = [
            ['id' => 'afdf1159-ff37-4ebc-897b-25ed07405a2f', 
            'razao_social' => 'Letícia Fernanda Gonçalves Silva 11380676606', 
            'cnpj' => '46339533000101', 
            'nome_fantasia' => 'Leman Multimarcas',
            'inscricao_estadual' => 'isento',
            'email' => 'leeticiafernanda93@gmail.com', 
            'status' => 'ativo', 
            'imagem' => 'imagem_padrao', 
            'user_cadastro_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'user_ultima_atualizacao_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'created_at' => now(), 
            'updated_at' => now()],
        ];

        DB::table('pessoa_juridica')->insert($pessoaJuridica);
    }
}
