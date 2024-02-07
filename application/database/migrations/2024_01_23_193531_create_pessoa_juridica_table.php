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
        Schema::create('pessoa_juridica', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('razao_social');
            $table->string('cnpj')->unique();
            $table->string('nome_fantasia')->nullable();
            $table->string('inscricao_estadual')->nullable();
            $table->string('inscricao_municipal')->nullable();
            $table->string('email')->nullable();
            $table->text('senha')->nullable();
            $table->enum('senha_temporaria', ['sim', 'nao'])->nullable();
            $table->enum('status', ['ativo', 'inativo', 'pendente-pagamento'])->default('ativo');
            $table->string('imagem')->nullable();
            $table->uuid('unidade_negocio_id');
            $table->uuid('user_cadastro_id');
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();

            $table->foreign('unidade_negocio_id')->references('id')->on('unidades_de_negocio');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoa_juridica');
    }
};
