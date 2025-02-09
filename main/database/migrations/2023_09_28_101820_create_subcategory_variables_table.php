<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoryVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategory_variables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('subcategory_id')->nullable();
            $table->string('label')->nullable();
            $table->string('type', 11)->nullable();
            $table->string('required', 50)->nullable();
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
        Schema::dropIfExists('subcategory_variables');
    }
}
