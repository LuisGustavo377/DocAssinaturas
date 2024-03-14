<?php
        
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GrupoNegocioSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $grupos_de_negocio = [
            ['id' => '028e5faa-dffc-4c11-ae05-b9ea59c3ccc7', 'nome' => 'Grupo Inicial', 'observacao' => null, 'status' => 'ativo','created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('grupos_de_negocio')->insert($grupos_de_negocio);
    }
}