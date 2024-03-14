<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContratoSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $contrato = [
            ['id' => '49c8c7d8-f125-4fb2-b4c1-2f0e3fdfcc71', 
            'numero_contrato' => '56456', 
            'plano_id' => 'fa9e9bad-7d30-40f9-bb69-a1d7952a5968', 
            'status' => 'ativo', 
            'user_cadastro_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'user_ultima_atualizacao_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'created_at' => now(), 
            'updated_at' => now()],
        ];

        DB::table('contratos')->insert($contrato);
    }
}
