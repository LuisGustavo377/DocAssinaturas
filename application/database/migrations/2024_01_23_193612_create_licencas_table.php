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
            $table->string('grupo');
            $table->string('numero_contrato');
            $table->string('descricao');
            $table->string('inicio');
            $table->string('termino');
            $table->string('limite_para_licencimento');
            $table->uuid('user_cadastro_id');
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();
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
