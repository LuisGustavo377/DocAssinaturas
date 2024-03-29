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
        Schema::create('pessoa_juridica_enderecos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->enum('status', ['ativo','inativo']);
            $table->integer('estado_id');
            $table->integer('cidade_id');
            $table->uuid('tipo_de_logradouro_id');
            $table->uuid('pessoa_juridica_id');
            $table->uuid('user_cadastro_id');
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();
            
            $table->foreign('pessoa_juridica_id')->references('id')->on('pessoa_juridica');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('cidade_id')->references('id')->on('cidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoa_juridica_enderecos');
    }
};
