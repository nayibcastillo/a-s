<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsForFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents_for_fields', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('variables_clinical_history_model_id');
            $table->integer('parent_id');
            $table->timestamp('created_at');
            $table->timestamp('update_at')->default('0000-00-00 00:00:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parents_for_fields');
    }
}
