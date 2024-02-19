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
        Schema::create('unidades_de_negocio', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('tipo_pessoa', ['pf', 'pj'])->nullable();
            $table->uuid('pessoa_id')->nullable();
            $table->uuid('user_cadastro_id');
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->uuid('grupo_negocio_id');
            $table->uuid('licenca_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('grupo_negocio_id')->references('id')->on('grupos_de_negocio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades_de_negocio');
    }
};
