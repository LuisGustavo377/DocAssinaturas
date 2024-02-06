<?php
        
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TiposDeRenovacaoSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $tipos_de_renovacao = [
            ['id' => Str::uuid(), 'descricao' => 'Anual', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Mensal', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Semestral', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Teste 7 Dias', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('tipos_de_renovacao')->insert($tipos_de_renovacao);
    }
}