<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProprietarioSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $proprietario = [
            ['id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5568', 
            'name' => 'Letícia Fernanda Gonçalves Silva', 
            'cpf_cnpj' => '11380676606', 
            'email' => 'leticia_fernanda93@live.com',  
            'pessoa_id' => '0964ad19-09fa-4e04-ba06-75c182411067', 
            'tipo_de_usuario' => 'proprietario', 
            'password'=>'$2y$12$x.vXWMvho4nnqn9s0r3dVukqCncez1DaIhPfM6yJNPkDv/BQafmDS',
            'password_temp'=>'true',
            'status' => 'ativo', 
            'user_cadastro_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'user_ultima_atualizacao_id' => '15f4d44e-3707-46ae-abec-b4a982d509d0',
            'unidade_de_negocio_id' => 'a1226e76-3cf6-4278-9875-1a3ed6df5567', 
            'created_at' => now(), 
            'updated_at' => now()],
        ];

        DB::table('proprietarios')->insert($proprietario);
    }
}
