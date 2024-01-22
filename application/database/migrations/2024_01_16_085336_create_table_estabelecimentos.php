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
        Schema::create('estabelecimentos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('regime', ['PJ', 'PF']);
            $table->string('nome');
            $table->string('cpf', 11)->nullable()->unique();
            $table->string('cnpj', 14)->nullable()->unique();
            $table->string('numero_telefone');
            $table->string('email')->unique();
            $table->string('senha')->nullable();
            $table->enum('senha_temporaria', ['sim', 'nao'])->nullable();
            $table->string('logo')->nullable();
            $table->enum('status', ['ativo', 'inativo', 'pendente-pagamento'])->default('ativo');
            $table->uuid('user_id');
            
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('admins');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estabelecimentos');
    }
};
