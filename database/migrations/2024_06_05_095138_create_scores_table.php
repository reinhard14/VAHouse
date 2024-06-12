<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('website')->nullable();
            $table->text('application')->nullable();
            $table->text('tool')->nullable();
            $table->text('skill')->nullable();
            $table->text('softskill')->nullable();
            $table->text('rate')->nullable();
            $table->text('videolink')->nullable();
            $table->text('portfolio')->nullable();
            $table->text('experience')->nullable();
            $table->text('resume')->nullable();
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
        Schema::dropIfExists('scores');
    }
}
