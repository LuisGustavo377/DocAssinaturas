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
        Schema::create('admins', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('tipo_de_usuario', ['admin-master','admin-padrao'])->default('admin-master');
            $table->string('password');
            $table->boolean('password_temp')->default(true);
            $table->enum('status', ['ativo','inativo','bloqueado'])->default('ativo');
            $table->uuid('user_cadastro_id')->nullable();
            $table->uuid('user_ultima_atualizacao_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};