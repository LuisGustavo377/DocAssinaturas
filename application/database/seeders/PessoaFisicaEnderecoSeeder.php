<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaFisicaEnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $pessoaFisicaEndereco = [
            
            'id' => '0964ad19-09fa-4e04-ba06-75c181411067', 
            'logradouro' => 'Francisco Coimbra', 
            'numero' => '168',
            'complemento' => 'Casa',
            'bairro' => 'Condomínio Eldorado',
            'status' => 'ativo', 
            'estado_id' => '31', 
            'cidade_id' => '3160405', 
            'tipo_de_logradouro_id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5566', 
            'pessoa_fisica_id' => '0964ad19-09fa-4e04-ba06-75c182411067', 
            'user_cadastro_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',            
            'created_at' => now(), 
            'updated_at' => now(),
        ];

        DB::table('pessoa_fisica_enderecos')->insert($pessoaFisicaEndereco);
    }
}
