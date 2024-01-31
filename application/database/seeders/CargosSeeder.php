<?php
        
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CargosSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $cargos = [
            ['id' => Str::uuid(), 'nome' => 'Gerente', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nome' => 'Auxiliar Administrativo', 'created_at' => now(), 'updated_at' => now()],

        ];

        DB::table('cargos')->insert($cargos);
    }
}