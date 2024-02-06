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
        Schema::create('licencas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('grupos_de_negocio_id');
            $table->string('numero_contrato');
            $table->string('descricao');
            $table->date('inicio');
            $table->date('termino');
            $table->enum('status', ['ativo', 'inativo','bloqueado']);
            $table->uuid('unidade_negocio_id')->nullable();
            $table->uuid('contrato_id')->nullable();
            $table->uuid('tipo_de_renovacao_id')->nullable();
            $table->uuid('user_cadastro_id')->nullable();
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('unidade_negocio_id')->references('id')->on('unidades_de_negocio');
            $table->foreign('grupos_de_negocio_id')->references('id')->on('grupos_de_negocio');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licencas');
    }
};
