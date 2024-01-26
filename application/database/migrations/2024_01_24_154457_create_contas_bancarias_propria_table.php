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
        Schema::create('contas_bancarias_propria', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('tipo_de_conta', ['CC', 'CP','PG']);
            $table->string('agencia');
            $table->string('numero_conta');
            $table->string('codigo_banco');
            $table->string('digito'); // verificar funcionamento               
            $table->uuid('user_cadastro_id');
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->timestamps();
                       
            $table->foreign('codigo_banco')->references('codigo')->on('bancos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_bancarias_propria');
    }
};
