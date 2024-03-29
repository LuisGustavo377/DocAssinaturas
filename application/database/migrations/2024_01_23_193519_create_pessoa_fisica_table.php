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
        Schema::create('pessoa_fisica', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('email')->nullable();
            $table->enum('status', ['ativo', 'inativo', 'pendente-pagamento'])->default('ativo');
            $table->string('imagem')->nullable();
            $table->uuid('unidade_de_negocio_id')->nullable();
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
        Schema::dropIfExists('pessoa_fisica');
    }
};
