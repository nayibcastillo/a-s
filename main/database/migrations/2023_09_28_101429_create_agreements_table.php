<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contract_number', 10)->nullable();
            $table->string('contract_name')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->string('regime_id')->nullable();
            $table->string('site')->nullable();
            $table->bigInteger('eps_id')->nullable();
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
        Schema::dropIfExists('agreements');
    }
}
