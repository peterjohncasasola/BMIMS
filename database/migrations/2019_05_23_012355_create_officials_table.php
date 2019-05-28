<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officials', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedBigInteger('resident_id')->nullable()->default(0);
            // $table->foreign('resident_id')->references('id')->on('residents');
            $table->string('name');
            $table->string('year_elected')->nullable();
            $table->string('year_end')->nullable();
            $table->string('status');
            $table->string('position');
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
        Schema::dropIfExists('officials');
    }
}
