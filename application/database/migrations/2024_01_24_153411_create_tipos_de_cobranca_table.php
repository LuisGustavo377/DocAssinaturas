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
        Schema::create('tipos_de_cobranca', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('descricao')->nullable();
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
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
        Schema::dropIfExists('tipos_de_cobranca');
    }
};
