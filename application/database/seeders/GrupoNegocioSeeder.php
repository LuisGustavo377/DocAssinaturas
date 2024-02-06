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
            ['id' => Str::uuid(), 'nome' => 'Grupo Inicial', 'observacao' => null, 'status' => 'ativo','created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('grupos_de_negocio')->insert($grupos_de_negocio);
    }
}