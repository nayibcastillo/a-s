<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRrhhActivityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rrhh_activity_types', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 100)->nullable();
            $table->string('color', 100)->nullable();
            $table->timestamps();
            $table->enum('state', ['activo', 'cancelado'])->default('Activo');
            
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
        Schema::dropIfExists('rrhh_activity_types');
    }
}
