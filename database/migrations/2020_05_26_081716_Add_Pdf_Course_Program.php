<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPdfCourseProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tablecourseprogram', function (Blueprint $table) {
            $table->string('pdf',255)->nullable();
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
            $table->dropColumn(['pdf']);
        });
    }
}
