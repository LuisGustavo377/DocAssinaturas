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
        Schema::create('pessoa_juridica_telefones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('telefone');
            $table->uuid('pessoa_id');
            $table->uuid('user_cadastro_id');
            $table->timestamps();

            $table->foreign('pessoa_id')->references('id')->on('pessoa_juridica');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoa_juridica_telefones');
    }
};
