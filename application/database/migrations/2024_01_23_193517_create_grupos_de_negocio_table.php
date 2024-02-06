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
        Schema::create('grupos_de_negocio', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome');
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->string('observacao')->nullable();
            $table->uuid('user_cadastro_id')->nullable();
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos_de_negocio');
    }
};
