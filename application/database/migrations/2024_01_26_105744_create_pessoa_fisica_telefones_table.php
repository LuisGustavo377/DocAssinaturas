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
        Schema::create('pessoa_fisica_telefones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('telefone');
            $table->enum('status', ['ativo', 'inativo']);
            $table->uuid('pessoa_fisica_id');
            $table->uuid('user_cadastro_id')->nullable();
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();
            
            $table->foreign('pessoa_fisica_id')->references('id')->on('pessoa_fisica');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoa_fisica_telefones');
    }
};
