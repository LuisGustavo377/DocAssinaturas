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
            ['id' => 'f38b765b-5d42-4b4c-84ba-1b6f48e4fd1a', 'descricao' => 'Anual', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '2bd4996c-b264-499e-9f5e-ff09298ad85c', 'descricao' => 'Mensal', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a4bf7375-cd57-4428-bce1-12a3d67e1684', 'descricao' => 'Semestral', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '1f5dc9ff-77d0-49c5-a3e9-6f4fda299ef5', 'descricao' => 'Teste 7 Dias', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('tipos_de_renovacao')->insert($tipos_de_renovacao);
    }
}