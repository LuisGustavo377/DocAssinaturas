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
            $table->string('telefone')->nullable();
            $table->string('tipo_de_logradouro')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->integer('estado_id');
            $table->integer('cidade_id');
            $table->uuid('tipo_de_logradouro_id');
            $table->text('senha')->nullable();
            $table->enum('senha_temporaria', ['sim', 'nao'])->nullable();
            $table->enum('status', ['ativo', 'inativo', 'pendente-pagamento'])->default('ativo');
            $table->string('imagem')->nullable();
            $table->uuid('unidade_negocio_id')->nullable();
            $table->uuid('user_cadastro_id')->nullable();
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();
    
            
            $table->foreign('unidade_negocio_id')->references('id')->on('unidades_de_negocio');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->foreign('tipo_de_logradouro_id')->references('id')->on('tipos_de_logradouro');
            
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
