<?php
        
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TiposCobrancaSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $tipos_de_transacao = [
            ['id' => Str::uuid(), 'descricao' => 'Boleto', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Pix', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Cartão de Crédito', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Cartão de Débito', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('tipos_de_transacao')->insert($tipos_de_transacao);
    }
}