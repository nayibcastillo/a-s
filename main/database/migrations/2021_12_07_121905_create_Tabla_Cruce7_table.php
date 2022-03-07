<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaCruce7Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tabla_Cruce7', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('IDENTIFICACION', 150)->nullable();
            $table->string('TIPO_DOCUMENTO', 100)->nullable();
            $table->string('EPS', 100)->nullable();
            $table->string('REGIMEN', 100)->nullable();
            $table->string('MUNICIPIO', 100)->nullable();
            $table->string('FFNN', 100)->nullable();
            $table->string('PRIMER_NOMBRE', 100)->nullable();
            $table->string('SEGUNDO_NOMBRE', 100)->nullable();
            $table->string('PRIMER_APELLIDO', 100)->nullable();
            $table->string('SEGUNDO_APELLIDO', 100)->nullable();
            $table->string('ESTADO', 100)->nullable();
            $table->integer('Actualizado')->nullable()->default(0);
            $table->integer('Ultimo')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tabla_Cruce7');
    }
}
