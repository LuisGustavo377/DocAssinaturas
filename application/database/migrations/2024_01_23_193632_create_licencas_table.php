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
            $table->string('descricao');
            $table->date('inicio');
            $table->date('termino');
            $table->string('limite_para_licencimento');
            $table->enum('status', ['ativo', 'inativo','bloqueado']);
            $table->enum('tipo_de_renovacao', ['anual', 'semestral','mensal']);
            $table->uuid('unidade_negocio_id');
            $table->uuid('contrato_id');
            $table->uuid('user_cadastro_id');
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('unidade_negocio_id')->references('id')->on('unidades_de_negocio');
            $table->foreign('contrato_id')->references('id')->on('contratos');
            
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
