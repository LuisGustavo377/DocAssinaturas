<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UnidadeDeNegocioSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $unidade = [
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5567', 
            'tipo_pessoa' => 'pf', 
            'pessoa_id' => '0964ad19-09fa-4e04-ba06-75c182411067', 
            'status' => 'ativo', 
            'user_cadastro_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'user_ultima_atualizacao_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'grupo_de_negocio_id' => '028e5faa-dffc-4c11-ae05-b9ea59c3ccc7', 
            'licenca_id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5566', 
            'created_at' => now(), 
            'updated_at' => now()],
        ];

        DB::table('unidades_de_negocio')->insert($unidade);
    }
}
