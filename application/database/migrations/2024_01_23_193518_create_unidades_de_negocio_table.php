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
            $table->enum('natureza', ['matriz', 'filial']);
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
        Schema::dropIfExists('unidades_de_negocio');
    }
};
