<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyAndColumnsToProprietariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proprietarios', function (Blueprint $table) {
            $table->uuid('unidade_de_negocio_id')->nullable();

            $table->foreign('unidade_de_negocio_id')
                  ->references('id')
                  ->on('unidades_de_negocio')
                  ->onDelete('set null'); // Opção de exclusão em cascata ou nulo, dependendo dos requisitos.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proprietarios', function (Blueprint $table) {
            $table->dropForeign(['unidade_de_negocio_id']);
            $table->dropColumn('unidade_de_negocio_id');
            $table->dropRememberToken();
            $table->dropTimestamps();
        });
    }
}