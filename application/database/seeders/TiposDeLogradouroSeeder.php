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
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5557', 'descricao' => 'Alameda','valor'=>'alameda', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'b1226e76-3cf6-4278-9875-1a3ed6df5568', 'descricao' => 'Área','valor'=>'area', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'c1226e76-3cf6-4278-9875-1a3ed6df5568', 'descricao' => 'Avenida','valor'=>'avenida', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'd1226e76-3cf6-4278-9875-1a3ed6df5568', 'descricao' => 'Campo','valor'=>'campo', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'e1226e76-3cf6-4278-9875-1a3ed6df5568', 'descricao' => 'Chácara','valor'=>'chacara', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'f1226e76-3cf6-4278-9875-1a3ed6df5568', 'descricao' => 'Colônia','valor'=>'colonia', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'f1226e76-3cf6-4278-9275-1a3ed6df5568', 'descricao' => 'Condomínio','valor'=>'condominio', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df4568', 'descricao' => 'Conjunto','valor'=>'conjunto', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9872-1a3ed6df5568', 'descricao' => 'Distrito','valor'=>'distrito', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9873-1a3ed6df5568', 'descricao' => 'Esplanada','valor'=>'esplanada', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9874-1a3ed6df5568', 'descricao' => 'Estação','valor'=>'estacao', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4178-9875-1a3ed6df5568', 'descricao' => 'Estrada','valor'=>'estrada', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9876-1a3ed6df5568', 'descricao' => 'Favela','valor'=>'favela', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9877-1a3ed6df5568', 'descricao' => 'Fazenda','valor'=>'fazenda', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9878-1a3ed6df5568', 'descricao' => 'Feira','valor'=>'feira', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9879-1a3ed6df5568', 'descricao' => 'Jardim','valor'=>'jardim', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4271-9875-1a3ed6df5568', 'descricao' => 'Ladeira','valor'=>'ladeira', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4272-9875-1a3ed6df5568', 'descricao' => 'Lago','valor'=>'lago', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4273-9875-1a3ed6df5568', 'descricao' => 'Lagoa','valor'=>'lagoa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4274-9875-1a3ed6df5568', 'descricao' => 'Largo','valor'=>'largo', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4275-9875-1a3ed6df5568', 'descricao' => 'Loteamento','valor'=>'loteamento', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4276-9875-1a3ed6df5568', 'descricao' => 'Morro','valor'=>'morro', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4277-9875-1a3ed6df5568', 'descricao' => 'Núcleo','valor'=>'nucleo', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5568', 'descricao' => 'Parque','valor'=>'parque', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4279-9875-1a3ed6df5568', 'descricao' => 'Passarela','valor'=>'passarela', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5561', 'descricao' => 'Pátio','valor'=>'patio', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5562', 'descricao' => 'Praça','valor'=>'praca', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5563', 'descricao' => 'Quadra','valor'=>'quadra', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5564', 'descricao' => 'Residencial','valor'=>'residencial', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5565', 'descricao' => 'Rodovia','valor'=>'rodovia', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5566', 'descricao' => 'Rua','valor'=>'rua', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5567', 'descricao' => 'Setor','valor'=>'setor', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5569', 'descricao' => 'Sítio','valor'=>'sitio', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5571', 'descricao' => 'Travessa','valor'=>'travessa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5572', 'descricao' => 'Trecho','valor'=>'trecho', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5573', 'descricao' => 'Trevo','valor'=>'trevo', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5574', 'descricao' => 'Vale','valor'=>'vale', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5575', 'descricao' => 'Vereda','valor'=>'vereda', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5576', 'descricao' => 'Via','valor'=>'via', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5577', 'descricao' => 'Viaduto','valor'=>'viaduto', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5578', 'descricao' => 'Viela','valor'=>'viela', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5579', 'descricao' => 'Vila','valor'=>'vila', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('tipos_de_logradouro')->insert($tipos_de_logradouro);
    }
}
