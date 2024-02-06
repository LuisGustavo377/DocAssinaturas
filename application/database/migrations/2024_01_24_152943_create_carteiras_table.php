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
        Schema::create('carteiras', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('saldo_disponivel');
            $table->string('saldo_bloqueado');
            $table->uuid('unidade_de_negocio_id');
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
        Schema::dropIfExists('carteiras');
    }
};
