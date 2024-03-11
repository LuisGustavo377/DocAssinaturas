<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unidades_de_negocio_clientes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('tipo_pessoa', ['pf', 'pj'])->nullable();
            $table->uuid('pessoa_id')->nullable();
            $table->uuid('unidade_de_negocio_id');
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->uuid('user_cadastro_id')->nullable();
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();

            $table->foreign('unidade_de_negocio_id')->references('id')->on('unidades_de_negocio');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades_de_negocio_clientes');
    }
};
