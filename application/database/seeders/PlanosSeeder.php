<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlanosSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $plano = [
            ['id' => Str::uuid(), 'nome' => 'Plano Inicial', 'valor' => 'valor','status' => 'ativo','created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nome' => 'Plano Avançado', 'valor' => 'valor','status' => 'ativo','created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nome' => 'Plano Personalizado', 'valor' => 'valor','status' => 'ativo','created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('planos')->insert($plano);
    }
}
