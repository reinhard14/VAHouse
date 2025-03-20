<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDaysAvailableAndSpecifyAndNegotiableToApplicantInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicant_information', function (Blueprint $table) {
            $table->string('specify')->nullable();
            $table->string('days_available')->nullable();
            $table->string('negotiable')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicant_information', function (Blueprint $table) {
            $table->dropColumn('specify');
            $table->dropColumn('days_available');
            $table->dropColumn('negotiable');
        });
    }
}
