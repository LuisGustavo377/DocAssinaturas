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
            $table->string('tipo_de_logradouro')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->integer('estado_id');
            $table->integer('cidade_id');
            $table->text('senha')->nullable();
            $table->enum('senha_temporaria', ['sim', 'nao'])->nullable();
            $table->enum('status', ['ativo', 'inativo', 'pendente-pagamento'])->default('ativo');
            $table->string('imagem')->nullable();
        // Inicio Dados Necessários quando a pessoa for Funcionário
            $table->string('rg')->nullable();
            $table->date('data_de_nascimento')->nullable();
            $table->enum('estado_civil', ['Solteiro(a)', 'Casado(a)', 'Viúvo(a)', 'Divorciado(a)', 'Casado(a)', 'União Estável', 'Anulado(a)']);
            $table->string('nacionalidade')->nullable();
            $table->string('nome_da_mae')->nullable();
            $table->string('nome_do_pai')->nullable();
            $table->string('titulo_de_eleitor')->nullable();
            $table->string('numero_pis_pasep')->nullable();
            $table->string('escolaridade')->nullable();
            
            // Fim Dados Necessários quando a pessoa for Funcionário
            $table->uuid('tipo_relacionamento_id')->nullable();
            // $table->uuid('cargo_id')->nullable();
            $table->uuid('unidade_negocio_id')->nullable();
            $table->uuid('user_cadastro_id')->nullable();
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();
    
            
            $table->foreign('tipo_relacionamento_id')->references('id')->on('tipos_de_relacionamento');
            $table->foreign('unidade_negocio_id')->references('id')->on('unidades_de_negocio');
            // $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('cidade_id')->references('id')->on('cidades');
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
