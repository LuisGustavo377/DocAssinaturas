<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArquivoContratoSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $arquivo = [
            ['id' => '51867215-6d92-4e6e-9815-33c7e8061abd', 
            'contrato_id' => '49c8c7d8-f125-4fb2-b4c1-2f0e3fdfcc71', 
            'numero_contrato'=>'5646',
            'user_cadastro_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'user_ultima_atualizacao_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'created_at' => now(), 
            'updated_at' => now()],
        ];

        DB::table('contratos_arquivos')->insert($arquivo);
    }
}
