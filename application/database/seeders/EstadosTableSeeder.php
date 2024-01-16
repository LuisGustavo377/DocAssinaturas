<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = date("Y-m-d H:i:s");

        DB::table("estados")->insert([
            [
                "id"         => 11,
                "nome"       => "Rondônia",
                "abreviacao"       => "RO",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 12,
                "nome"       => "Acre",
                "abreviacao"       => "AC",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 13,
                "nome"       => "Amazonas",
                "abreviacao"       => "AM",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 14,
                "nome"       => "Roraima",
                "abreviacao"       => "RR",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 15,
                "nome"       => "Pará",
                "abreviacao"       => "PA",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 16,
                "nome"       => "Amapá",
                "abreviacao"       => "AP",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 17,
                "nome"       => "Tocantins",
                "abreviacao"       => "TO",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 21,
                "nome"       => "Maranhão",
                "abreviacao"       => "MA",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 22,
                "nome"       => "Piauí",
                "abreviacao"       => "PI",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 23,
                "nome"       => "Ceará",
                "abreviacao"       => "CE",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 24,
                "nome"       => "Rio Grande do Norte",
                "abreviacao"       => "RN",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 25,
                "nome"       => "Paraíba",
                "abreviacao"       => "PB",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 26,
                "nome"       => "Pernambuco",
                "abreviacao"       => "PE",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 27,
                "nome"       => "Alagoas",
                "abreviacao"       => "AL",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 28,
                "nome"       => "Sergipe",
                "abreviacao"       => "SE",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 29,
                "nome"       => "Bahia",
                "abreviacao"       => "BA",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 31,
                "nome"       => "Minas Gerais",
                "abreviacao"       => "MG",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 32,
                "nome"       => "Espírito Santo",
                "abreviacao"       => "ES",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 33,
                "nome"       => "Rio de Janeiro",
                "abreviacao"       => "RJ",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 35,
                "nome"       => "São Paulo",
                "abreviacao"       => "SP",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 41,
                "nome"       => "Paraná",
                "abreviacao"       => "PR",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 42,
                "nome"       => "Santa Catarina",
                "abreviacao"       => "SC",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 43,
                "nome"       => "Rio Grande do Sul",
                "abreviacao"       => "RS",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 50,
                "nome"       => "Mato Grosso do Sul",
                "abreviacao"       => "MS",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 51,
                "nome"       => "Mato Grosso",
                "abreviacao"       => "MT",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 52,
                "nome"       => "Goiás",
                "abreviacao"       => "GO",
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "id"         => 53,
                "nome"       => "Distrito Federal",
                "abreviacao"       => "DF",
                "created_at" => $now,
                "updated_at" => $now,
            ],
        ]);

    }

}
