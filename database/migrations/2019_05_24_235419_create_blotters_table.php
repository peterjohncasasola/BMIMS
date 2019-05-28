<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlottersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blotters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('complained_residentid');
            $table->foreign('complained_residentid')->references('id')->on('residents');
            $table->string('case_no');
            $table->string('case_name');
            $table->string('filing_date');
            $table->string('complainant')->nullable();
            $table->text('complainant_details')->nullable();
            $table->unsignedBigInteger('complainant_residentid');
            $table->foreign('complainant_residentid')->references('id')->on('residents');
            $table->string('action_taken')->nullable()->default('');
            $table->string('status');
            $table->string('description');
            $table->unsignedBigInteger('officer_residentid');
            $table->foreign('officer_residentid')->references('id')->on('officials');
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
        Schema::dropIfExists('blotters');
    }
}
