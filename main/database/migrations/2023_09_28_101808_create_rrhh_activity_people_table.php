<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRrhhActivityPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rrhh_activity_people', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('person_id')->nullable();
            $table->integer('rrhh_activity_id')->nullable();
            $table->enum('state', ['activo', 'cancelado'])->default('Activo');
            $table->timestamps();
            
            $table->index(['1'], 'Índice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rrhh_activity_people');
    }
}
