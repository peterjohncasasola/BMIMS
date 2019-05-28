<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('house_no')->nullable();
            $table->boolean('is_voter')->nullable()->default(0);
            $table->boolean('is_familyhead')->nullable()->default(0);
            $table->boolean('is_pwa')->nullable()->default(0);
            $table->boolean('is_senior')->nullable()->default(0);
            $table->boolean('is_househead')->nullable()->default(0);
            $table->string('first_name')->nullable();
            $table->string('resident_id')->default();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('alias_name')->nullable();
            $table->string('purok')->nullable();
            $table->string('street_address')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('extension_name')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('course_degree')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('educational_attainment')->nullable();
            $table->string('occupation')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('dialect')->nullable();
            $table->string('income_bracket')->nullable();
            $table->string('income_source')->nullable();
            $table->string('religion')->nullable();
            $table->double('height')->nullable();
            $table->double('weight')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('blood_type')->nullable();
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
        Schema::dropIfExists('residents');
    }
}
