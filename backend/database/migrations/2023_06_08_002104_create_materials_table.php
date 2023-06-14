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
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tipo_id');
            $table->unsignedInteger('fornecedor_id');
            $table->string('descricao');
            $table->string('quantidade');
            $table->string('preco');
            $table->string('data_cadastro');
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipo_materiais');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materiais', function (Blueprint $table) {
            $table->dropConstrainedForeignId('tipo_id');
            $table->dropConstrainedForeignId('fornecedor_id');
        });

        Schema::dropIfExists('materiais');
    }
};
