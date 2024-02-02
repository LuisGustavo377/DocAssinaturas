<?php
        
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TiposDeLogradouroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos_de_logradouro = [
            ['id' => Str::uuid(), 'descricao' => 'Alameda','valor'=>'alameda', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Área','valor'=>'area', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Avenida','valor'=>'avenida', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Campo','valor'=>'campo', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Chácara','valor'=>'chacara', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Colônia','valor'=>'colonia', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Condomínio','valor'=>'condominio', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Conjunto','valor'=>'conjunto', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Distrito','valor'=>'distrito', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Esplanada','valor'=>'esplanada', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Estação','valor'=>'estacao', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Estrada','valor'=>'estrada', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Favela','valor'=>'favela', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Fazenda','valor'=>'fazenda', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Feira','valor'=>'feira', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Jardim','valor'=>'jardim', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Ladeira','valor'=>'ladeira', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Lago','valor'=>'lago', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Lagoa','valor'=>'lagoa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Largo','valor'=>'largo', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Loteamento','valor'=>'loteamento', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Morro','valor'=>'morro', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Núcleo','valor'=>'nucleo', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Parque','valor'=>'parque', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Passarela','valor'=>'passarela', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Pátio','valor'=>'patio', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Praça','valor'=>'praca', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Quadra','valor'=>'quadra', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Residencial','valor'=>'residencial', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Rodovia','valor'=>'rodovia', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Rua','valor'=>'rua', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Setor','valor'=>'setor', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Sítio','valor'=>'sitio', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Travessa','valor'=>'travessa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Trecho','valor'=>'trecho', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Trevo','valor'=>'trevo', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Vale','valor'=>'vale', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Vereda','valor'=>'vereda', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Via','valor'=>'via', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Viaduto','valor'=>'viaduto', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Viela','valor'=>'viela', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'descricao' => 'Vila','valor'=>'vila', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('tipos_de_logradouro')->insert($tipos_de_logradouro);
    }
}
