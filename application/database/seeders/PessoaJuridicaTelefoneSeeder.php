<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaJuridicaTelefoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $pessoaJuridicaTelefone = 
            [
            'id' => '0964ad19-09fa-4e04-ba06-75c183411067', 
            'telefone' => '(37) 99999-1169', 
            'status' => 'ativo', 
            'pessoa_juridica_id' => 'afdf1159-ff37-4ebc-897b-25ed07405a2f', 
            'user_cadastro_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',            
            'created_at' => now(), 
            'updated_at' => now(),
        ];

        DB::table('pessoa_juridica_telefones')->insert($pessoaJuridicaTelefone);
    }
}
