<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LicencaSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $licenca = [
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5566', 
            'grupo_de_negocio_id' => '028e5faa-dffc-4c11-ae05-b9ea59c3ccc7', 
            'numero_contrato' => '65456', 
            'descricao' => 'Grupo Inicial-65456-001', 
            'inicio' => '2021-01-01', 
            'termino' => '2021-01-31',            
            'status' => 'ativo',
            'unidade_de_negocio_id'=>'a1226e76-3cf6-4278-9875-1a3ed6df5567',
            'contrato_id'=>'49c8c7d8-f125-4fb2-b4c1-2f0e3fdfcc71',            
            'tipo_de_renovacao_id'=>'1f5dc9ff-77d0-49c5-a3e9-6f4fda299ef5',            
            'user_cadastro_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'user_ultima_atualizacao_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'created_at' => now(), 
            'updated_at' => now()],
        ];

        DB::table('licencas')->insert($licenca);
    }
}
