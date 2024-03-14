<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PessoaFisicaSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $pessoaFisica = [
            ['id' => '0964ad19-09fa-4e04-ba06-75c182411067', 
            'nome' => 'Letícia Fernanda Gonçalves Silva', 
            'cpf' => '11380676606', 
            'email' => 'leticia_fernanda93@live.com', 
            'status' => 'ativo', 
            'imagem' => 'imagem_padrao', 
            'user_cadastro_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'user_ultima_atualizacao_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'created_at' => now(), 
            'updated_at' => now()],
        ];

        DB::table('pessoa_fisica')->insert($pessoaFisica);
    }
}
