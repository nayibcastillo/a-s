<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioPuntoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Funcionario_Punto', function (Blueprint $table) {
            $table->bigInteger('Id_Funcionario_Punto')->primary();
            $table->bigInteger('Id_Punto_Dispensacion')->nullable();
            $table->bigInteger('Identificacion_Funcionario')->nullable();
            $table->timestamp('Fecha')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Funcionario_Punto');
    }
}
