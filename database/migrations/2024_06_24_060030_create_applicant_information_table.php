<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_information', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('rate')->nullable();
            $table->string('videolink')->nullable();
            $table->string('portfolio')->nullable();
            $table->string('experience')->nullable();
            $table->string('resume')->nullable();
            $table->string('skype')->nullable();
            $table->string('niche')->nullable();
            $table->string('ub_account')->nullable();
            $table->string('ub_number')->nullable();
            $table->string('photo_id')->nullable();
            $table->string('photo_formal')->nullable();
            $table->string('disc_results')->nullable();
            $table->string('positions')->nullable();
            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicant_information');
    }
}
