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
        Schema::create('pessoas_fisica_conta_bancaria', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('tipo_de_conta', ['conta-corrente', 'conta-poupanca','conta-pagamento']);
            $table->string('agencia');
            $table->string('numero_conta');
            $table->string('codigo_banco');
            $table->string('digito'); // verificar funcionamento  
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');             
            $table->uuid('pessoa_fisica_id');
            $table->uuid('banco_id');
            $table->uuid('user_cadastro_id');
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();

            $table->foreign('pessoa_fisica_id')->references('id')->on('pessoa_fisica');                       
            $table->foreign('codigo_banco')->references('codigo')->on('bancos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas_fisica_conta_bancaria');
    }
};
