<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_ins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Id_Llamada', 100)->nullable();
            $table->unsignedBigInteger('Identificacion_Paciente');
            $table->unsignedBigInteger('Identificacion_Agente');
            $table->unsignedBigInteger('Tipo_Tramite')->nullable();
            $table->unsignedBigInteger('Tipo_Servicio')->nullable();
            $table->unsignedBigInteger('Ambito')->nullable();
            $table->timestamps();
            $table->enum('status', ['pendiente', 'atendida'])->default('Pendiente');
            $table->enum('type', ['presencial', 'callcenter'])->default('CallCenter');
            $table->dateTime('finalized_at')->nullable();
            $table->string('Observation', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_ins');
    }
}
