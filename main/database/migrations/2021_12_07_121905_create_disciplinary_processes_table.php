<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinaryProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplinary_processes', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('person_id')->nullable();
            $table->string('process_description', 50);
            $table->date('date_of_admission')->nullable();
            $table->date('date_end')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->enum('status', ['Abierto', 'Cerrado'])->nullable()->default('Abierto');
            $table->string('file', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disciplinary_processes');
    }
}
