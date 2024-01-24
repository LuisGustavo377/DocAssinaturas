<?php
        
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TiposRelacionamentoSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $tipos_de_relacionamento = [
            ['id' => Str::uuid(), 'descricao' => 'Sócio', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Sócio Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Gerente', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Funcionário', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Cliente', 'created_at' => now(), 'updated_at' => now()],

        ];

        DB::table('tipos_de_relacionamento')->insert($tipos_de_relacionamento);
    }
}