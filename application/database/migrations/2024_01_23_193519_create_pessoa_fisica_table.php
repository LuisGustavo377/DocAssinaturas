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
            $table->enum('tipo_logradouro', ['Alameda', 'Área', 'Avenida', 'Campo', 'Chácara', 'Colônia', 'Condomínio', 'Conjunto', 'Distrito', 'Esplanada', 'Estação', 'Estrada', 'Favela', 'Fazenda', 'Feira', 'Jardim', 'Ladeira', 'Lago', 'Lagoa', 'Largo', 'Loteamento', 'Morro', 'Núcleo', 'Parque', 'Passarela', 'Pátio', 'Praça', 'Quadra', 'Residencial', 'Rodovia', 'Rua', 'Setor', 'Sítio', 'Travessa', 'Trecho', 'Trevo', 'Vale', 'Vereda', 'Via', 'Viaduto', 'Viela', 'Vila']);
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
            $table->string('nome_da_mãe')->nullable();
            $table->string('nome_do_pai')->nullable();
            $table->string('titulo_de_eleitor')->nullable();
            $table->string('numero_pis_pasep')->nullable();
            $table->string('escolaridade')->nullable();
            $table->string('cargo')->nullable();
            // Fim Dados Necessários quando a pessoa for Funcionário
            $table->uuid('tipo_relacionamento_id');
            $table->uuid('unidade_negocio_id');
            $table->uuid('user_cadastro_id');
            $table->timestamps();
    
            
            $table->foreign('tipo_relacionamento_id')->references('id')->on('tipos_de_relacionamento');
            $table->foreign('unidade_negocio_id')->references('id')->on('unidades_de_negocio');
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
