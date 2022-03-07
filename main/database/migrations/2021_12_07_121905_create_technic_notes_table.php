<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technic_notes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->bigInteger('contract_id')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('anio', 10)->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technic_notes');
    }
}
