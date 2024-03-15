<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaFisicaTelefoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $pessoaFisicaTelefone = 
            [
            'id' => '0964ad19-09fa-4e04-ba06-75c183411067', 
            'telefone' => '(37) 99999-1169', 
            'status' => 'ativo', 
            'pessoa_fisica_id' => '0964ad19-09fa-4e04-ba06-75c182411067', 
            'user_cadastro_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',            
            'created_at' => now(), 
            'updated_at' => now(),
        ];

        DB::table('pessoa_fisica_telefones')->insert($pessoaFisicaTelefone);
    }
}
