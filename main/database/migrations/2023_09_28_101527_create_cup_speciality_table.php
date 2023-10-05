<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCupSpecialityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cup_speciality', function (Blueprint $table) {
            $table->string('cup_code', 9)->nullable();
            $table->integer('cup_id')->nullable();
            $table->integer('speciality_id')->nullable();
            $table->string('speciality_name', 32)->nullable();
            $table->bigIncrements('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cup_speciality');
    }
}
