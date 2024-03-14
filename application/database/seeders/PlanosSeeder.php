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
            ['id' => 'fa9e9bad-7d30-40f9-bb69-a1d7952a5968', 'nome' => 'Plano Inicial', 'valor' => 'valor','status' => 'ativo','created_at' => now(), 'updated_at' => now()],
            ['id' =>   'fa9e9bad-7d30-40f9-bb69-a1d7952a5967', 'nome' => 'Plano Avançado', 'valor' => 'valor','status' => 'ativo','created_at' => now(), 'updated_at' => now()],
            ['id' => 'fa9e9bad-7d30-40f9-bb69-a1d7952a5966', 'nome' => 'Plano Personalizado', 'valor' => 'valor','status' => 'ativo','created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('planos')->insert($plano);
    }
}
