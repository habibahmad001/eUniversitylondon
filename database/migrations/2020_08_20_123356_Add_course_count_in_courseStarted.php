<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourseCountInCourseStarted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tablecoursestarted', function (Blueprint $table) {
            $table->string('ProgramCount', 256)->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tablecoursestarted', function (Blueprint $table) {
            $table->dropColumn(['ProgramCount']);
        });
    }
}
