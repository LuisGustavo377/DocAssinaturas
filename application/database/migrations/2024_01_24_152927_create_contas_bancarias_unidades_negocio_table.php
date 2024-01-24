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
        Schema::create('contas_bancarias_unidades_negocio', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('tipo_de_conta', ['conta-corrente', 'conta-poupanca','conta-pagamento']);
            $table->string('agencia');
            $table->string('numero_conta');
            $table->string('codigo_banco');
            $table->string('digito'); // verificar funcionamento               
            $table->uuid('unidade_de_negocio_id');
            $table->uuid('banco_id');
            $table->timestamps();

            $table->foreign('unidade_de_negocio_id')->references('id')->on('unidades_de_negocio');                       
            $table->foreign('codigo_banco')->references('codigo')->on('bancos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_bancarias_unidades_negocio');
    }
};
