<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddetionalDataCourseProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tablecourseprogram', function (Blueprint $table) {
            $table->string('videoLink', 256)->nullable();
            $table->text('doc')->nullable();
            $table->text('OtherData')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tablecourseprogram', function (Blueprint $table) {
            $table->dropColumn(['videoLink', 'doc', 'OtherData']);
        });
    }
}
