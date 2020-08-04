<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfferInCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tablecourses', function (Blueprint $table) {
            $table->string('OfferData', 256)->nullable();
            $table->timestamp('StartDate')->nullable();
            $table->timestamp('EndDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tablecourses', function (Blueprint $table) {
            $table->dropColumn(['OfferData', 'StartDate', 'EndDate']);
        });
    }
}
